<?php

namespace App\Actions\Category;

use Illuminate\Database\Eloquent\Model;

class CategoryDeleteByIdAction
{
    public function execute(Model $category): bool|null
    {
        return $category->delete();
    }
}
