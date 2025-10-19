<?php

namespace App\Utis;

use Illuminate\Support\Str;

class ImageManager
{
    public static function uploadImages($request, $post)
    {
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $path = self::ImagePath($image,'posts');
                $post->images()->create([
                    'path' => $path,
                ]);

            }
        }
    }

public static function ImagePath($image, $fileUpload)
{
    
                $fileName = Str::uuid().time().'.'.$image->getClientOriginalExtension();
                $path = $image->storeAs('uploads/'.$fileUpload, $fileName, ['disk' => 'uploads']);
                return $path;
    
}







}

