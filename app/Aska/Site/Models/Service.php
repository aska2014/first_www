<?php namespace Aska\Site\Models;

use Aska\BaseModel;
use Aska\Media\Models\Image;
use Aska\Media\Models\Video;
use Aska\SlugGenerator;

class Service extends BaseModel {

    use SlugGenerator;

    /**
     * @var string
     */
    protected $table = 'site_services';

    /**
     * @var array
     */
    protected $fillable = array('slug', 'en_title', 'en_small_description', 'en_long_description',
        'ar_title', 'ar_small_description', 'ar_long_description', 'category_id');

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            'category_id' => 'required',
            'en_title' => 'required|unique:site_services,en_title'.($this->exists ? ",{$this->id}": "")
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ServiceCategory::getClass(), 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function videos()
    {
        return $this->morphMany(Video::getClass(), 'videoable');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::getClass(), 'imageable');
    }
}