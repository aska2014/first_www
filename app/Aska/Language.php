<?php namespace Aska;

use Session, Config;

class Language {

    /**
     * @param $language
     */
    public function set($language)
    {
        Session::put('language', $language);
    }

    /**
     * @return mixed
     */
    public function get()
    {
        if(Session::has('language')) {

            return Session::get('language');
        }

        // Return default language
        return Config::get('app.locale');
    }
}