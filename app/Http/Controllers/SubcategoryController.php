<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = Category::findOrFail($validated['category_id']);

        abort_unless(
            (int) $category->user_id === (int) Auth::id(),
            403
        );

        $category->subcategories()->create([
            'name' => $validated['name'],
        ]);

        return back()->with('status', 'Subcategory created.');
    }

    public function destroy(Subcategory $subcategory): RedirectResponse
    {
        abort_unless(
            (int) $subcategory->category->user_id === (int) Auth::id(),
            403
        );

        $subcategory->delete();

        return back()->with('status', 'Subcategory deleted.');
    }
}