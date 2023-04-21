<?php

namespace App\Actions\Category;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryListPaginateAction
{
    public function execute(array $columns = ['*'], string $order = 'DESC', $limit = 4): LengthAwarePaginator
    {
        $data = Category::select($columns)->orderBy('updated_at', $order)->paginate($limit);
        return $data;
    }
}
