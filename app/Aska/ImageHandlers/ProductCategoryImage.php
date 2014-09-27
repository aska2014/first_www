<?php namespace Aska\ImageHandlers;

use Aska\Site\Models\ProductCategory;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class ProductCategoryImage extends ModelImage {

    /**
     * @param UploadedFile $file
     * @param ProductCategory $productCategory
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function setMainImage(UploadedFile $file, ProductCategory $productCategory)
    {
        // If image exists then delete first
        if($image = $productCategory->image) $image->delete();

        $path = 'albums/product-category/category'.$productCategory->id.''.rand(0,10000).'.jpg';

        $fullpath = public_path($path);

        $this->makeSurePathExists($fullpath);

        Image::make($file)->save($fullpath);

        return $productCategory->image()->create(compact('path'));
    }
} 