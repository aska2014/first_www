<?php namespace Aska\Media\Models;

use Aska\Site\Models\Product;
use Lifeentity\Images\ImageDB;

class Image extends ImageDB {

    /**
     * @var array
     */
    protected $appends = array('url');

    /**
     * @param $query
     * @return mixed
     */
    public function scopeByProducts($query)
    {
        return $query->where('imageable_type', Product::getClass());
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return $this->getOriginalUrlAttribute();
    }

    /**
     * @return string
     */
    public static function getClass()
    {
        return get_called_class();
    }
}