<?php

namespace App\Actions\Products;

use Illuminate\Database\Eloquent\Model;

class ProductDeleteByIdAction
{
    public function execute(Model $product, $id): bool|null
    {
        $pro = $product::findOrFail($id);
        $product = $pro->delete();
        return $product;
    }
}
