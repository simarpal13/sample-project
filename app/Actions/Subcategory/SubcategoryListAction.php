<?php

namespace App\Actions\Subcategory;

use App\Models\Subcategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SubcategoryListAction
{
    public function execute(string $order = 'DESC', $limit = 4): LengthAwarePaginator
    {
        $data = Subcategory::with('category')->orderByDesc('updated_at', $order)->paginate($limit);
        return $data;
    }
}
