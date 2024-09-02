<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return view('dashboard.owner.category.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.owner.category.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $validated['slug'] = Str::slug($validated['name']);

            Category::create($validated);
        });

        return redirect()->route('dashboard.category.index')
            ->with('successfullAddCategory', 'Successfully added a new Category.');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        return view('dashboard.owner.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $slug): RedirectResponse
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        DB::transaction(function () use ($request, $category) {
            $validated = $request->validated();

            $validated['slug'] = Str::slug($validated['name']);

            $category->update($validated);
        });

        return redirect()->route('dashboard.category.index')
            ->with('updatedCategory', 'Successfully changed the category.');
    }

    public function destroy($slug): RedirectResponse
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        DB::beginTransaction();

        try {
            $category->delete();

            DB::commit();

            return redirect()->route('dashboard.category.index')
                ->with('successDeleteCategory', 'Successfully deleted the category.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('dashboard.category.index')
                ->with('errorDeleteCategory', 'Failed to delete the category.');
        }
    }
}
