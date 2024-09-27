<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('id', 'desc');

        $search = $request->input('search');

        if ($search != '') {
            $categories = $categories->where('name', 'like', '%' . $search . '%');
        }

        $categories = $categories->get();

        return view('dashboard.owner.category.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.owner.category.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $slug = Str::slug($validated['name']);

            $slugCheck = Category::where('slug', 'like', "$slug%")->count();

            if ($slugCheck > 0) {
                $slug = "{$slug}-" . ($slugCheck + 1);
            }

            $validated['slug'] = $slug;

            Category::create($validated);

            DB::commit();

            return redirect()->route('dashboard.category.index')
                ->with('successfullyAddedCategory', 'Successfully added a new Category');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('dashboard.category.index')
                ->with('failedAddCategory', 'Failed add to new Category');
        }

    }

    public function edit(Category $category)
    {
        return view('dashboard.owner.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {

            $validated['slug'] = Str::slug($validated['name']);

            $category->update($validated);

            DB::commit();

            return redirect()->route('dashboard.category.index')
                ->with('updatedCategorySuccess', 'Successfully changed the category');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('dashboard.category.index')
                ->with('updateCategoryFailed', 'Failed to changed category');
        }

    }

    public function destroy(Category $category): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $category->delete();

            DB::commit();

            return redirect()->route('dashboard.category.index')
                ->with('successDeleteCategory', 'Successfully deleted the category');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->route('dashboard.category.index')
                ->with('failedDeleteCategory', 'Failed to delete the category');
        }
    }
}
