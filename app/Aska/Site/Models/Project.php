<?php namespace Aska\Site\Models;

use Aska\BaseModel;
use Aska\Media\Models\Image;
use Aska\SlugGenerator;

class Project extends BaseModel {

    use SlugGenerator;

    /**
     * @var string
     */
    protected $table = 'site_projects';

    /**
     * @var array
     */
    protected $fillable = array('slug', 'en_title', 'en_small_description', 'en_long_description',
        'ar_title', 'ar_small_description', 'ar_long_description');

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            'en_title' => 'required|unique:site_projects,en_title'.($this->exists ? ",{$this->id}": "")
        );
    }

    /**
     * @return mixed
     */
    public function getTitleAttribute()
    {
        return $this->getLanguageAttribute('title');
    }

    /**
     * @return mixed
     */
    public function getSmallDescriptionAttribute()
    {
        return $this->getLanguageAttribute('small_description');
    }

    /**
     * @return mixed
     */
    public function getLongDescriptionAttribute()
    {
        return $this->getLanguageAttribute('long_description');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::getClass(), 'imageable');
    }
}