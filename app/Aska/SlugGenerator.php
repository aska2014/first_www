<?php namespace Aska;

use Illuminate\Support\Str;

Trait SlugGenerator {

    /**
     * @param $query
     * @param $slug
     * @return mixed
     */
    public function scopeBySlug($query ,$slug)
    {
        return $query->where('slug', $slug);
    }


    /**
     * @param $attribute
     */
    public function setEnTitleAttribute($attribute)
    {
        $this->attributes['en_title'] = $attribute;

        $this->attributes['slug'] = Str::slug($attribute);
    }
} 