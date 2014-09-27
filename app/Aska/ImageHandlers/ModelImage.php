<?php namespace Aska\ImageHandlers;

use Aska\Media\Models\Image;

class ModelImage {

    /**
     * @var Image
     */
    protected $images;

    /**
     * @param Image $images
     */
    public function __construct(Image $images)
    {
        $this->images = $images;
    }

    /**
     * @param $path
     */
    protected function makeSurePathExists($path)
    {
        $folder = dirname($path);

        if(! file_exists($folder)) {

            mkdir($folder, 0777, true);
        }
    }
} 