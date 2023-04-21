<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryListAction
{
    public function execute(array $columns = ['*'], string $order = 'DESC'): Collection
    {
        $data = Category::select($columns)->orderBy('updated_at', $order)->get();
        return $data;
    }
}
