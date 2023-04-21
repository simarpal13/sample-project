<?php

namespace App\Actions\Category;

use App\Models\Category;

class CategoryCreateAction
{
    public function execute(array $requestData): Category
    {
        $data = Category::create($requestData);
        return $data;
    }
}
