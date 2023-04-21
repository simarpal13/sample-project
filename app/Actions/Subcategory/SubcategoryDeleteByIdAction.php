<?php

namespace App\Actions\Subcategory;


use Illuminate\Database\Eloquent\Model;


class SubcategoryDeleteByIdAction
{
    public function execute(Model $subcategory): bool|null
    {
        return $subcategory->delete();
    }
}
