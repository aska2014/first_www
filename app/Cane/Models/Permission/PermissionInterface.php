<?php namespace Cane\Models\Permission;


interface PermissionInterface {

    /**
     * Check this permission against the given name
     *
     * @param $resource
     * @param $action
     * @return mixed
     */
    public function check($resource, $action);

} 