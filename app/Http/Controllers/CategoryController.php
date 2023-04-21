<?php

namespace App\Http\Controllers;

use App\Actions\Category\CategoryByIdAction;
use App\Actions\Category\CategoryCreateAction;
use App\Actions\Category\CategoryDeleteByIdAction;
use App\Actions\Category\CategoryEditAction;
use App\Actions\Category\CategoryListAction;
use App\Actions\Category\CategoryListPaginateAction;
use App\Models\Category;
use App\Http\Requests\CategoryRequest; //Category: validation logic
use Illuminate\Http\Request;
use Inertia\Inertia; //Custom Import

class CategoryController extends Controller
{
    public function index(CategoryListPaginateAction $categoryListPaginateAction)
    {
        $categories = $categoryListPaginateAction->execute();
        return Inertia::render('Category/Index', compact('categories'));
    }

    public function create()
    {
        return Inertia::render('Category/Create');
    }

    public function store(CategoryRequest $request, CategoryCreateAction $categoryCreateAction)
    {
        try {
            $validated = $request->validated(); //Get validated data
            $categoryCreateAction->execute($validated);
            return redirect()->route('categories')->with('successmsg', 'Category added');
        } catch (\Exception $e) {
            return redirect()->route('create.category')->with('errormsg', $e->getMessage());
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id, CategoryByIdAction $categoryByIdAction)
    {
        try {
            $category = $categoryByIdAction->execute($id);
            return Inertia::render('Category/Edit', compact('category'));
        } catch (\Exception $e) {
            return redirect()->route('categories');
        }
    }

    public function update(CategoryRequest $request, $id, CategoryEditAction $categoryEditAction)
    {
        try {
            $validated = $request->validated();
            $categoryEditAction->execute($validated, $id);
            return redirect()->route('categories')->with('successmsg', 'Category updated');
        } catch (\Exception $e) {
            return redirect()->route('edit.category', $id)->with('errormsg', $e->getMessage());
        }
    }

    public function destroy($id, CategoryByIdAction $categoryByIdAction, CategoryDeleteByIdAction $categoryDeleteByIdAction)
    {
        try {
            $category = $categoryByIdAction->execute($id);
            $categoryDeleteByIdAction->execute($category);
            return redirect()->route('categories')->with('successmsg', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('categories')->with('errormsg', 'Please try again later');
        }
    }
}
