<?php

namespace App\Actions\File;

use Illuminate\Http\UploadedFile;

class ImageStoreAction
{
    public function execute(UploadedFile $file, string $dir, string $file_name = null): string
    {
        /* Image Uploading logic appear here */
        if (!$file_name) {
            $imageName = time() . '.' . $file->extension(); //Rename image file
        } else {
            $imageName = $file_name;
        }
        $imagePath = $file->storeAs($dir, $imageName, 'public'); //Move image to folder
        return $imagePath;
    }
}
