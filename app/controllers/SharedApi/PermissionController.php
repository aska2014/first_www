<?php namespace SharedApi;

use BaseController, Config;

class PermissionController extends BaseController {

    /**
     * @return mixed
     */
    public function site()
    {
        return Config::get('permissions.site');
    }

    /**
     * @return mixed
     */
    public function bms()
    {
        return Config::get('permissions.bms');
    }

} 