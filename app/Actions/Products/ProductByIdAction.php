<?php

namespace App\Actions\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductByIdAction
{
    public function execute($product_id): Collection
    {
        $product = Product::with(['category:id,name', 'subcategory:id,name'])->where('id', $product_id)->get();
        return $product;
    }
}
