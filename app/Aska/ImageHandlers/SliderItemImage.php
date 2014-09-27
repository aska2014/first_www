<?php namespace Aska\ImageHandlers;

use Aska\Site\Models\SliderItem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class SliderItemImage extends ModelImage {

    /**
     * @param UploadedFile $file
     * @param SliderItem $item
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setMainImage(UploadedFile $file, SliderItem $item)
    {
        // If image exists then delete first
        if($image = $item->image) $image->delete();

        $path = 'albums/sliders/slider'.$item->id.''.rand(0,10000).'.jpg';

        $fullpath = public_path($path);

        $this->makeSurePathExists($fullpath);

        Image::make($file)->save($fullpath);

        return $item->image()->create(compact('path'));
    }
}