<?php

namespace App\Actions\Category;

use App\Models\Category;

class CategoryByIdAction
{
    public function execute(int $id, array $columns = ['id', 'name', 'description']): Category
    {
        $data = Category::select($columns)->findOrFail($id);
        return $data;
    }
}
