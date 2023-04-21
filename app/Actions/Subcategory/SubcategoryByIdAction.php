<?php

namespace App\Actions\Subcategory;

use App\Models\Subcategory;

class SubcategoryByIdAction
{
    public function execute(int $subcategoryid, array $columns = ['id', 'name', 'description', 'category_id']): Subcategory
    {
        $data = Subcategory::select($columns)->findOrFail($subcategoryid);
        return $data;
    }
}
