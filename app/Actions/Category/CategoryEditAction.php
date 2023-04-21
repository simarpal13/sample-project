<?php

namespace App\Actions\Category;

use App\Models\Category;

class CategoryEditAction
{
    public function execute(array $requestData, int $id): int
    {
        $data = Category::where('id', $id)->update($requestData);
        return $data;
    }
}
