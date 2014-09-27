<?php namespace Aska\Site\Models;

use Aska\BaseModel;

class Slider extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'site_sliders';

    /**
     * @var array
     */
    protected $fillable = array('page');

    /**
     * @param $query
     * @param $page
     * @return mixed
     */
    public function scopeByPage($query, $page)
    {
        return $query->where('page', $page);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return array();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(SliderItem::getClass(), 'slider_id');
    }
}