<?php namespace Aska\ImageHandlers;

use Aska\Site\Models\News;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class NewsImage extends ModelImage {

    /**
     * @param UploadedFile $file
     * @param \Aska\Site\Models\News $news
     * @return mixed
     */
    public function addGalleryImage(UploadedFile $file, News $news)
    {
        $path = 'albums/news/'.$news->slug.''.$news->id.rand(0,10000).'.jpg';

        $fullpath = public_path($path);

        $this->makeSurePathExists($fullpath);

        Image::make($file)->save($fullpath);

        return $news->images()->create(compact('path'));
    }

} 