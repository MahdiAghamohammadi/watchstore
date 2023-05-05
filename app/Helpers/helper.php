<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function saveImage($file, $folder)
{
    if ($file) {
        $name = time() . '.' . $file->extension();
        $smallImage = Image::make($file->getRealPath());
        $bigImage = Image::make($file->getRealPath());
        $smallImage->resize(256, 256, function ($constraint) {
            $constraint->aspectRatio();
        });

        Storage::disk('local')->put("admin/{$folder}/small/" . $name, (string)$smallImage->encode('png', 90));
        Storage::disk('local')->put("admin/{$folder}/big/" . $name, (string)$bigImage->encode('png', 90));
        return $name;
    } else {
        return '';
    }
}
