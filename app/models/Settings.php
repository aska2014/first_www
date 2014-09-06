<?php

class Settings extends \Illuminate\Database\Eloquent\Model {

    /**
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var array
     */
    protected $fillable = array('main_password');
}