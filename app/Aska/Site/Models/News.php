<?php namespace Aska\Site\Models;

use Aska\BaseModel;
use Aska\Media\Models\Image;
use Aska\SlugGenerator;

class News extends BaseModel {

    use SlugGenerator;

    /**
     * @var string
     */
    protected $table = 'news';

    /**
     * @var array
     */
    protected $fillable = array('slug', 'en_title', 'ar_title', 'en_description', 'ar_description');

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            'en_title' => 'required|unique:news,en_title'.($this->exists ? ",{$this->id}": "")
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
    public function getDescriptionAttribute()
    {
        return $this->getLanguageAttribute('description');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::getClass(), 'imageable');
    }
}