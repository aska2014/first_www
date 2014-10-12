<?php namespace Aska\Site\Models;

use Aska\BaseModel;

class ContactEmail extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'contact_emails';

    /**
     * @var array
     */
    protected $fillable = array('email');

    public function rules()
    {
        return array(
            'email' => 'required|email'
        );
    }
}