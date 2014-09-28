<?php namespace Aska\Site\Models;

use Aska\BaseModel;

class InfoSlider extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'info_sliders';

    /**
     * @var array
     */
    protected $fillable = array('ar_title', 'en_title');

    /**
     * @return array
     */
    public function rules()
    {
       return array(
       );
    }

    /**
     * @return string
     */
    public function getTitleAttribute()
    {
        return $this->getLanguageAttribute('title');
    }

} 