<?php namespace Aska\Site\Models;

use Aska\BaseModel;
use Aska\Media\Models\Image;

class SliderItem extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'site_slider_items';

    /**
     * @var array
     */
    protected $fillable = array('en_title', 'en_description', 'ar_title', 'ar_description', 'slider_id');

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            'slider_id' => 'required',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slider()
    {
        return $this->belongsTo(Slider::getClass(), 'slider_id');
    }

} 