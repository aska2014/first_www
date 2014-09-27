<?php namespace Aska\Site\Permissions;

use Aska\Permission;

class ImagePermission extends Permission {

    /**
     * @return bool
     */
    public function canCreate()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function canDelete()
    {
        return true;
    }

}