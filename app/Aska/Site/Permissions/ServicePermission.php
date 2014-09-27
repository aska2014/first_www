<?php namespace Aska\Site\Permissions;

use Aska\Permission;
use Aska\Site\Models\Service;

class ServicePermission extends Permission {

    /**
     * Check if user has permission to create this resource
     */
    public function canCreate()
    {
        return $this->sessionUser->user()->hasPermission('site', 'all');
    }

    /**
     * Check if user has permission to update this resource
     */
    public function canUpdate(Service $service)
    {
        return $this->sessionUser->user()->hasPermission('site', 'all');
    }

    /**
     * Check if user has permission to delete this resource
     */
    public function canDelete(Service $service)
    {
        return $this->sessionUser->user()->hasPermission('site', 'all');
    }


} 