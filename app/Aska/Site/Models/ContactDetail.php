<?php namespace Aska\Site\Models;

use Aska\BaseModel;

class ContactDetail extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'contact_details';

    /**
     * @var array
     */
    protected $fillable = array('en_company_name', 'ar_company_name', 'en_address', 'ar_address', 'email', 'mobile_no',
        'facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'google');

    /**
     * @return array
     */
    public function rules()
    {
        return array();
    }

    /**
     * @return mixed
     */
    public function getCompanyNameAttribute()
    {
        return $this->getLanguageAttribute('company_name');
    }

    /**
     * @return mixed
     */
    public function getAddressAttribute()
    {
        return $this->getLanguageAttribute('address');
    }
}