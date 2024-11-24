<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait ImageUploadTrait {

    /**
     * Upload an image to the specified path.
     */
    public function uploadImage(Request $request, $inputName, $path)
    {
        if ($request->hasFile($inputName)) {
            $image = $request->file($inputName);
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;
            $image->move(public_path($path), $imageName);

            // Return the correct image path
            return $path . '/' . $imageName;
        }
    }

    /**
     * Update the image, delete the old one, and save the new one.
     */
    public function updateImage(Request $request, $inputName, $path, $oldPath = null)
    {
        if ($request->hasFile($inputName)) {
            // Delete the old image if it exists
            if (File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            $image = $request->file($inputName);
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;
            $image->move(public_path($path), $imageName);

            // Return the correct image path
            return $path . '/' . $imageName;
        }
    }

    /**
     * Delete the image from the storage.
     */
    public function deleteImage(string $path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
