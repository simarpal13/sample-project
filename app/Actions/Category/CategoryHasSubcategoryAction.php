<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryHasSubcategoryAction
{
    public function execute(array $columms = ['*']): Collection
    {
        $data = Category::select($columms)->has('subcategories')->get();
        return $data;
    }
}
