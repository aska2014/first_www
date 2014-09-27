<?php namespace Aska\Site\Models;

use Aska\BaseModel;
use Aska\Media\Models\Image;
use Aska\SlugGenerator;

class ProductCategory extends BaseModel {

    use SlugGenerator;

    /**
     * @var string
     */
    protected $table = 'site_product_categories';

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
            'en_title' => 'required|unique:site_product_categories,en_title'.($this->exists ? ",{$this->id}": "")
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
        return $this->belongsTo(ProductCategory::getClass(), 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(ProductCategory::getClass(), 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::getClass(), 'category_id');
    }
}