<?php namespace Aska\Site\Models;

use Aska\BaseModel;
use Aska\SlugGenerator;

class Page extends BaseModel {

    use SlugGenerator;

    /**
     * @var string
     */
    protected $table = 'pages';

    /**
     * @var array
     */
    protected $fillable = array('slug', 'ar_title', 'en_title', 'ar_sub_title', 'en_sub_title', 'sections');

    /**
     * @var array
     */
    protected $with = array('sections');

    /**
     * @return array
     */
    public function rules()
    {
        return array(
        );
    }

    /**
     * @param $inputs
     */
    public function setSectionsAttribute($inputs)
    {
        $this->syncMany($this->sections(), $inputs);
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
    public function getSubTitleAttribute()
    {
        return $this->getLanguageAttribute('sub_title');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany(PageSection::getClass());
    }
}