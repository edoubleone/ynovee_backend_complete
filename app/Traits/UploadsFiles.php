<?php

namespace App\Traits;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

trait UploadsFiles
{
    /**
     * Upload a file to Cloudinary and return the secure URL.
     *
     * @param Request $request
     * @param string $key The input key (e.g. 'image_url')
     * @param string $folder Cloudinary folder
     * @return string|null
     */
    public function uploadFile(Request $request, $key = 'image_url', $folder = 'uploads')
    {
        if ($request->hasFile($key)) {
            $file = $request->file($key);
            $result = Cloudinary::uploadApi()->upload($file->getRealPath(), ['folder' => $folder]);
            return $result['secure_url'];
        }

        return $request->input($key);
    }
}
