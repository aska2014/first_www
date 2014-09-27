<?php namespace Aska\ImageHandlers;

use Aska\Site\Models\Product;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class ProductImage extends ModelImage {

    /**
     * @param UploadedFile $file
     * @param Product $product
     * @return mixed
     */
    public function addGalleryImage(UploadedFile $file, Product $product)
    {
        $path = 'albums/product/'.$product->slug.''.$product->id.rand(0,10000).'.jpg';

        $fullpath = public_path($path);

        $this->makeSurePathExists($fullpath);

        Image::make($file)->save($fullpath);

        return $product->images()->create(compact('path'));
    }
}