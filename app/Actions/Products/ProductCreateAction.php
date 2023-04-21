<?php

namespace App\Actions\Products;

use App\Models\Product;
use App\Actions\File\ImageStoreAction;

class ProductCreateAction
{
    public function execute($requestData, $request, ImageStoreAction $imageStoreAction): Product
    {
        /* Image Uploading logic appear here */
        if ($request->hasFile('image')) { //If input has file
            $imageName = $imageStoreAction->execute($request->file('image'), $dir = 'product_images');
            $requestData['image'] = $imageName;
        }
        $product = Product::create($requestData); //Insert Product
        return $product;
    }
}
