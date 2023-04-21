<?php

namespace App\Actions\Products;

use App\Models\Product;

class ProductEditAction
{
    public function execute($requestData, $request, $imageStoreAction): int
    {
        /* Image Uploading logic appear here */
        if ($request->hasFile('image')) { //If input has file
            $imageName = $imageStoreAction->execute($request->file('image'), $dir = 'product_images');
            $requestData['image'] = $imageName;
        }
        $data = Product::where('id', $request->product_id)->update($requestData); //Edit Product
        return $data;
    }
}
