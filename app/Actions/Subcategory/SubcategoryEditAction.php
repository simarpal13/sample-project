<?php

namespace App\Actions\Subcategory;

use App\Models\Subcategory;

class SubcategoryEditAction
{
    public function execute($validatedData, $id): int
    {
        $data = Subcategory::where('id', $id)->update($validatedData);
        return $data;
    }
}
