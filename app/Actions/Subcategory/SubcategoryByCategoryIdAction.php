<?php

namespace App\Actions\Subcategory;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Collection;

class SubcategoryByCategoryIdAction
{
    public function execute(int $category_id, array $columns = ['*']): Collection
    {
        $data = Subcategory::select($columns)->with('category')->where('category_id', '=', $category_id)->get();
        return $data;
    }
}
