<?php

namespace App\Http\Controllers;

use App\Actions\Category\CategoryListAction;
use App\Actions\Subcategory\SubcategoryByIdAction;
use App\Actions\Subcategory\SubcategoryCreateAction;
use App\Actions\Subcategory\SubcategoryDeleteByIdAction;
use App\Actions\Subcategory\SubcategoryEditAction;
use App\Actions\Subcategory\SubcategoryListAction;
use App\Models\Subcategory;
use App\Http\Requests\SubcategoryRequest; //Subcategory: validation logic
use Inertia\Inertia; //Custom Import

class SubcategoryController extends Controller
{
    public function index(SubcategoryListAction $subcategoryListAction)
    {
        $subcategories = $subcategoryListAction->execute();
        return Inertia::render('Subcategory/Index', compact('subcategories'));
    }

    public function create(CategoryListAction $categoryListAction)
    {

        $categories = $categoryListAction->execute();
        return Inertia::render('Subcategory/Create', compact('categories'));
    }

    public function store(SubcategoryRequest $request, SubcategoryCreateAction $subcategoryCreateAction)
    {
        try {
            $validated = $request->validated();
            $subcategoryCreateAction->execute($validated);
            return redirect()->route('subcategories')->with('successmsg', 'Subcategory added');
        } catch (\Exception $e) {
            return redirect()->route('create.subcategory')->with('errormsg', $e->getMessage());
        }
    }

    public function show(subcategory $subcategory)
    {
        //
    }

    public function edit($subcategoryid, CategoryListAction $categoryListAction, SubcategoryByIdAction $subcategoryByIdAction)
    {
        try {
            $categories = $categoryListAction->execute(['id', 'name']);
            $subcategory = $subcategoryByIdAction->execute($subcategoryid);
            return Inertia::render('Subcategory/Edit', compact('categories', 'subcategory'));
        } catch (\Exception $e) {
            return redirect()->route('subcategories')->with('errormsg', $e->getMessage());
        }
    }

    public function update(SubcategoryRequest $request, $subcategoryid, SubcategoryEditAction $subcategoryEditAction)
    {
        try {
            $validated = $request->validated();
            $subcategoryEditAction->execute($validated, $subcategoryid);
            return redirect()->route('subcategories')->with('successmsg', 'Subcategory Updated');
        } catch (\Exception $e) {
            return redirect()->route('subcategories')->with('errormsg', $e->getMessage());
        }
    }

    public function destroy($id, SubcategoryByIdAction $subcategoryByIdAction, SubcategoryDeleteByIdAction $subcategoryDeleteByIdAction)
    {
        try {
            $subcategory = $subcategoryByIdAction->execute($id);
            $subcategoryDeleteByIdAction->execute($subcategory);
            return redirect()->route('subcategories')->with('successmsg', 'Subcategory deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('subcategories')->with('errormsg', $e->getMessage());
        }
    }
}
