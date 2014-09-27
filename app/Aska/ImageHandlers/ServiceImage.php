<?php namespace Aska\ImageHandlers;

use Aska\Site\Models\Service;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class ServiceImage extends ModelImage {

    /**
     * @param UploadedFile $file
     * @param Service $service
     * @return mixed
     */
    public function addGalleryImage(UploadedFile $file, Service $service)
    {
        $path = 'albums/service/'.$service->slug.''.$service->id.rand(0,10000).'.jpg';

        $fullpath = public_path($path);

        $this->makeSurePathExists($fullpath);

        Image::make($file)->save($fullpath);

        return $service->images()->create(compact('path'));
    }
} 