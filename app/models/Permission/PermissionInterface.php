<?php
namespace Permission;


interface PermissionInterface {

    /**
     * Check this permission against the given name
     *
     * @param $name
     * @return mixed
     */
    public function check($name);

} 