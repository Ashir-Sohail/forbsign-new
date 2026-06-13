<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileUploadHelper
{
    public static function upload($file, string $folder)
    {
        if (config('filesystems.use_s3')) {

            $path = $file->store($folder, 's3');
            Storage::disk('s3')->setVisibility($path, 'public');

            return $path;
        }

        // Local storage (public disk)
        return $file->store($folder, 'public');
    }

    public static function delete($path)
    {
        if (!$path) return;

        if (config('filesystems.use_s3')) {

            if (Storage::disk('s3')->exists($path)) {
                Storage::disk('s3')->delete($path);
            }

        } else {

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }

    public static function url($path)
    {
        if (!$path) return null;

        return config('filesystems.use_s3')
            ? Storage::disk('s3')->url($path)
            : asset('storage/' . $path);
    }
}