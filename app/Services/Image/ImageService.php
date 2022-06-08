<?php

namespace App\Services\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function saveImage(UploadedFile $image): string
    {
        $name = $image->getClientOriginalName();
        $name = str_replace(' ', '', $name);
        if(Storage::disk('public_uploads')->exists($name)){
            $name = time() . $name;
        }

        Storage::disk('public_uploads')
            ->putFileAs('/upload/uploads/languages/', $image, $name);


       return url('/') . '/upload/uploads/languages/' . $name;

    }
}
