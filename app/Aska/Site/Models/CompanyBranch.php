<?php namespace Aska\Site\Models;

use Aska\BaseModel;

class CompanyBranch extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'company_branches';

    /**
     * @var array
     */
    protected $fillable = array('en_title', 'en_sub_title', 'en_address',
        'ar_title', 'ar_sub_title', 'ar_address', 'mobile_no', 'email', 'gps_latitude', 'gps_longitude');

    /**
     * @return array
     */
    public function rules()
    {
        return array(
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
    public function getSubTitleAttribute()
    {
        return $this->getLanguageAttribute('sub_title');
    }

    /**
     * @return mixed
     */
    public function getAddressAttribute()
    {
        return $this->getLanguageAttribute('address');
    }

} 