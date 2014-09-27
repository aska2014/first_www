<?php namespace Aska\ImageHandlers;

use Aska\Site\Models\Project;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class SiteProjectImage extends ModelImage {

    /**
     * @param UploadedFile $file
     * @param \Aska\Site\Models\Project $project
     * @return mixed
     */
    public function addGalleryImage(UploadedFile $file, Project $project)
    {
        $path = 'albums/project/'.$project->slug.''.$project->id.rand(0,10000).'.jpg';

        $fullpath = public_path($path);

        $this->makeSurePathExists($fullpath);

        Image::make($file)->save($fullpath);

        return $project->images()->create(compact('path'));
    }

} 