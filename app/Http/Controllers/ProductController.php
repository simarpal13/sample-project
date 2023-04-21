<?php

namespace App\Http\Controllers;

use App\Actions\Category\CategoryHasSubcategoryAction;
use App\Actions\Products\ProductCreateAction;
use App\Actions\Products\ProductEditAction;
use App\Actions\Products\ProductListAction;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductRequest; //Product: validation logic
use Illuminate\Support\Facades\DB; //Query Builder: import
use Inertia\Inertia; //Custom Import

use Illuminate\Http\Request;
use App\Actions\File\ImageStoreAction;
use App\Actions\Products\ProductByIdAction;
use App\Actions\Products\ProductDeleteByIdAction;
use App\Actions\Subcategory\SubcategoryByCategoryIdAction;

class ProductController extends Controller
{

    public function index(ProductListAction $productListAction)
    {
        $products = $productListAction->execute();
        return Inertia::render('Product/Index', compact('products'));
    }

    public function create(CategoryHasSubcategoryAction $categoryHasSubcategoryAction, SubcategoryByCategoryIdAction $subcategoryByCategoryIdAction, $category_id = null)
    {
        return Inertia::render('Product/Create', [

            // ALWAYS included on first visit - OPTIONALLY included on partial reloads - ALWAYS evaluated            
            'categories' => $categoryHasSubcategoryAction->execute(),

            // NEVER included on first visit - OPTIONALLY included on partial reloads - ONLY evaluated when needed
            'subcategories' => Inertia::lazy(
                fn () =>
                $subcategoryByCategoryIdAction->execute($category_id)
            ),
        ]);
    }

    public function store(ProductRequest $request, ProductCreateAction $productCreateAction)
    {
        try {
            $validated = $request->validated();
            $productCreateAction->execute($validated, $request, (new ImageStoreAction));
            return redirect()->route('products')->with('successmsg', 'Product Added');
        } catch (\Exception $e) {
            return redirect()->route('products')->with('errormsg', $e->getMessage());
        }
    }

    public function edit($product_id, $category_id, CategoryHasSubcategoryAction $categoryHasSubcategoryAction, SubcategoryByCategoryIdAction $subcategoryByCategoryIdAction, ProductByIdAction $productByIdAction)
    {
        return Inertia::render('Product/Edit', [
            'categories' => $categoryHasSubcategoryAction->execute(),
            'subcategories' => $subcategoryByCategoryIdAction->execute($category_id),
            'product' => $productByIdAction->execute($product_id)
        ]);
    }


    public function update(ProductRequest $request, ProductEditAction $productEditAction, ImageStoreAction $imageStoreAction)
    {
        try {
            $validated = $request->validated(); //Get validated data
            $productEditAction->execute($validated, $request, $imageStoreAction);
            return redirect()->route('products')->with('successmsg', 'Product Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->route('products')->with('errormsg', $e->getMessage());
        }
    }

    public function destroy(Product $product, $id, ProductDeleteByIdAction $productDeleteByIdAction)
    {
        try {
            $productDeleteByIdAction->execute($product, $id);
            return redirect()->route('products')->with('successmsg', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('products')->with('errormsg', $e->getMessage());
        }
    }
}
