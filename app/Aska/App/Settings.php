<?php namespace Aska\App;

use Aska\BaseModel;

class Settings extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var array
     */
    protected $fillable = array('main_password');
}