<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Create a new category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',

                Rule::unique('categories', 'name')
                    ->where(
                        fn ($query) => $query->where(
                            'user_id',
                            $request->user()->id
                        )
                    ),
            ],

            'color' => [
                'nullable',
                'string',
                'max:20',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $nextSortOrder = Category::query()
            ->where('user_id', $request->user()->id)
            ->max('sort_order');

        $category = Category::create([
            'user_id' => $request->user()->id,

            'name' => $validated['name'],

            'slug' => $this->generateUniqueSlug(
                $validated['name'],
                $request->user()->id
            ),

            'color' => $validated['color'] ?? '#F5B942',

            'icon' => $validated['icon'] ?? null,

            'sort_order' => ($nextSortOrder ?? 0) + 1,
        ]);

        return redirect()
            ->route('categories.show', $category)
            ->with(
                'status',
                'Category created.'
            );
    }

    /**
     * Display a category and its tasks.
     */
    public function show(
        Request $request,
        Category $category
    ): View {
        $this->ensureOwnership(
            $request,
            $category
        );

        $category->load([
            'subcategories',
        ]);

        $tasks = Task::query()
            ->where('user_id', $request->user()->id)
            ->where('category_id', $category->id)
            ->with([
                'subcategory',
            ])
            ->orderByRaw('is_completed ASC')
            ->orderByRaw('due_at IS NULL ASC')
            ->orderBy('due_at')
            ->get();

        $subcategories = $category
            ->subcategories()
            ->orderBy('name')
            ->get();

        return view(
            'categories.show',
            [
                'category' => $category,
                'tasks' => $tasks,
                'subcategories' => $subcategories,
            ]
        );
    }

    /**
     * Update a category.
     */
    public function update(
        Request $request,
        Category $category
    ): RedirectResponse {
        $this->ensureOwnership(
            $request,
            $category
        );

        $validated = $request->validate([
            'name' => [
                'sometimes',
                'required',
                'string',
                'max:100',

                Rule::unique('categories', 'name')
                    ->where(
                        fn ($query) => $query->where(
                            'user_id',
                            $request->user()->id
                        )
                    )
                    ->ignore($category->id),
            ],

            'color' => [
                'sometimes',
                'nullable',
                'string',
                'max:20',
            ],

            'icon' => [
                'sometimes',
                'nullable',
                'string',
                'max:100',
            ],

            'sort_order' => [
                'sometimes',
                'integer',
                'min:0',
            ],
        ]);

        if (
            array_key_exists('name', $validated)
            && $validated['name'] !== $category->name
        ) {
            $validated['slug'] =
                $this->generateUniqueSlug(
                    $validated['name'],
                    $request->user()->id,
                    $category->id
                );
        }

        $category->update(
            $validated
        );

        return redirect()
            ->route(
                'categories.show',
                $category
            )
            ->with(
                'status',
                'Category updated.'
            );
    }

    /**
     * Delete a category.
     *
     * Tasks are NOT deleted.
     *
     * They are detached from the category instead.
     */
    public function destroy(
        Request $request,
        Category $category
    ): RedirectResponse {
        $this->ensureOwnership(
            $request,
            $category
        );

        DB::transaction(
            function () use ($category) {

                /*
                 * Keep all tasks.
                 *
                 * Remove their category/subcategory association
                 * before deleting the category.
                 */
                Task::query()
                    ->where(
                        'category_id',
                        $category->id
                    )
                    ->update([
                        'category_id' => null,
                        'subcategory_id' => null,
                    ]);

                /*
                 * Delete the subcategories belonging
                 * to this category.
                 */
                Subcategory::query()
                    ->where(
                        'category_id',
                        $category->id
                    )
                    ->delete();

                /*
                 * Finally delete the category.
                 */
                $category->delete();
            }
        );

        return redirect()
            ->route('dashboard')
            ->with(
                'status',
                'Category deleted.'
            );
    }

    /**
     * Make sure users can only manage
     * their own categories.
     */
    private function ensureOwnership(
        Request $request,
        Category $category
    ): void {
        abort_unless(
            (int) $category->user_id
                === (int) $request->user()->id,
            403
        );
    }

    /**
     * Generate a unique category slug
     * for the current user.
     */
    private function generateUniqueSlug(
        string $name,
        int $userId,
        ?int $ignoreCategoryId = null
    ): string {
        $baseSlug = Str::slug($name);

        if ($baseSlug === '') {
            $baseSlug = 'category';
        }

        $slug = $baseSlug;

        $counter = 2;

        while (
            Category::query()
                ->where('user_id', $userId)
                ->where('slug', $slug)
                ->when(
                    $ignoreCategoryId,
                    fn ($query) =>
                        $query->where(
                            'id',
                            '!=',
                            $ignoreCategoryId
                        )
                )
                ->exists()
        ) {
            $slug =
                $baseSlug . '-' . $counter;

            $counter++;
        }

        return $slug;
    }
}