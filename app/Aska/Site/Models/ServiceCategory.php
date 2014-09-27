<?php namespace Aska\Site\Models;

use Aska\BaseModel;
use Aska\Media\Models\Image;
use Aska\SlugGenerator;

class ServiceCategory extends BaseModel {

    use SlugGenerator;

    /**
     * @var string
     */
    protected $table = 'site_service_categories';

    /**
     * @var array
     */
    protected $fillable = array('slug', 'en_title', 'en_description', 'ar_title', 'ar_description', 'parent_id');

    /**
     * @return array
     */
    public function rules()
    {
        return array(
            'en_title' => 'required|unique:site_service_categories,en_title'.($this->exists ? ",{$this->id}": "")
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
    public function parent()
    {
        return $this->belongsTo(ServiceCategory::getClass(), 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(ServiceCategory::getClass(), 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::getClass(), 'category_id');
    }

} 