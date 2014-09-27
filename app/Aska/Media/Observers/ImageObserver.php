<?php namespace Aska\Media\Observers;

use Aska\Media\Models\Image;

class ImageObserver {

    /**
     * Delete file too.
     *
     * @param Image $image
     */
    public function deleting(Image $image)
    {
        if(file_exists(public_path($image->path))) {

            // Delete file from server
            unlink(public_path($image->path));
        }
    }

} 