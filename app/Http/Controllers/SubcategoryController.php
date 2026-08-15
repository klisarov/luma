<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    public function store(Request $request, Category $category): RedirectResponse
    {
        abort_unless($category->user_id === Auth::id(), 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category->subcategories()->create($validated);

        return back()->with('status', 'Subcategory created.');
    }

    public function destroy(Subcategory $subcategory): RedirectResponse
    {
        abort_unless($subcategory->category->user_id === Auth::id(), 403);

        $subcategory->delete();

        return back()->with('status', 'Subcategory deleted.');
    }
}