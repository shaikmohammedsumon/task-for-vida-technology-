<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ImageHelper
{
    public static function upload(UploadedFile $file, string $path): string
    {
        $imageName = Auth::id() . '-' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $imageName);
        return $imageName;
    }

     public static function delete($path, $imageName)
    {
        $fullPath = public_path($path . '/' . $imageName);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
            return true;
        }
        return false;
    }
}
