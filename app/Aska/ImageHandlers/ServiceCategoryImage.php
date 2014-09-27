<?php namespace Aska\ImageHandlers;

use Aska\Site\Models\ServiceCategory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class ServiceCategoryImage extends ModelImage {

    /**
     * @param UploadedFile $file
     * @param ServiceCategory $serviceCategory
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setMainImage(UploadedFile $file, ServiceCategory $serviceCategory)
    {
        // If image exists delete first file and from db too
        if($image = $serviceCategory->image) $image->delete();

        $path = 'albums/service-category/category'.$serviceCategory->id.''.rand(0,10000).'.jpg';

        $fullpath = public_path($path);

        $this->makeSurePathExists($fullpath);

        Image::make($file)->save($fullpath);

        return $serviceCategory->image()->create(compact('path'));
    }
}