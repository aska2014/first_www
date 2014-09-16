<?php namespace Cane\Observers;

use Cane\Helpers\MimeType;
use Cane\Models\Drive\File;

class FileObserver {

    /**
     * @param File $file
     */
    public function saving(File $file)
    {
        // Set type for clients to easily organize files
        if(MimeType::isImage($file->url)) {
            $file->type = 'image';
        } else if(MimeType::isDoc($file->url)) {
            $file->type = 'doc';
        } else if(MimeType::isPdf($file->url)) {
            $file->type = 'pdf';
        }
    }

    /**
     * @param File $file
     */
    public function deleting(File $file)
    {
        if(file_exists($file->path)) {

            // Delete file from local storage as well
            unlink($file->path);
        }
    }

} 