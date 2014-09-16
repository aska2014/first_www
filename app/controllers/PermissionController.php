<?php

class PermissionController extends BaseController {

    public function index()
    {
        return Config::get('permissions');
    }

} 