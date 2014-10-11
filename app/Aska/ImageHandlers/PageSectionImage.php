<?php namespace Aska\ImageHandlers;

use Aska\Site\Models\PageSection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class PageSectionImage extends ModelImage {

    /**
     * @param UploadedFile $file
     * @param PageSection $pageSection
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setMainImage(UploadedFile $file, PageSection $pageSection)
    {
        // If image exists delete first file and from db too
        if($image = $pageSection->image) $image->delete();

        $path = 'albums/page-sections/section'.$pageSection->id.''.rand(0,10000).'.jpg';

        $fullpath = public_path($path);

        $this->makeSurePathExists($fullpath);

        Image::make($file)->save($fullpath);

        return $pageSection->image()->create(compact('path'));
    }
}