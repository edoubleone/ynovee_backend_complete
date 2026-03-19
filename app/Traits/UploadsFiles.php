<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UploadsFiles
{
    /**
     * Upload a file and return the public URL.
     *
     * @param Request $request
     * @param string $key The input key (e.g. 'image_url')
     * @param string $directory Storage directory
     * @return string|null
     */
    public function uploadFile(Request $request, $key = 'image_url', $directory = 'uploads')
    {
        if ($request->hasFile($key)) {
            $file = $request->file($key);
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($directory, $filename, 'public');
            $url = Storage::disk('public')->url($path);
            
            // Normalize URL to remove redundant or escaped slashes (except after protocol)
            return preg_replace('/([^:])\/\/*/', '$1/', str_replace('\\/', '/', $url));
        }

        // Return existing string if no new file is uploaded (backward compatibility or direct URL)
        $input = $request->input($key);
        if (is_string($input)) {
            return preg_replace('/([^:])\/\/*/', '$1/', str_replace('\\/', '/', $input));
        }
        return $input;
    }
}
