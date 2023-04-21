<?php

namespace App\Actions\Subcategory;

use App\Models\Subcategory;

class SubcategoryCreateAction
{
    public function execute(array $requestData): Subcategory
    {
        $data = Subcategory::create($requestData); //Insert subcategory
        return $data;
    }
}
