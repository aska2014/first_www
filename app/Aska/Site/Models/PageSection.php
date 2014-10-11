<?php namespace Aska\Site\Models;

use Aska\BaseModel;
use Aska\Media\Models\Image;
use Aska\Media\Models\Video;
use Illuminate\Support\Str;

class PageSection extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'page_sections';

    /**
     * @var array
     */
    protected $fillable = array('ar_title', 'en_title', 'ar_description', 'en_description');

    /**
     * @var array
     */
    protected $with = array('image', 'video');

    /**
     * @return string
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->en_title);
    }

    /**
     * @return string
     */
    public function getTitleAttribute()
    {
        return $this->getLanguageAttribute('title');
    }

    /**
     * @return string
     */
    public function getDescriptionAttribute()
    {
        return $this->getLanguageAttribute('description');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::getClass(), 'imageable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function video()
    {
        return $this->morphOne(Video::getClass(), 'videoable');
    }
}