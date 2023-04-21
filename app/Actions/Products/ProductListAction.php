<?php

namespace App\Actions\Products;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductListAction
{
    public function execute(string $order = "DESC", int $limit = 5): LengthAwarePaginator
    {
        $data = Product::with(['category', 'subcategory'])->orderBy('updated_at', $order)->paginate($limit);
        return $data;
    }
}
