<?php namespace Aska\Site\Permissions;

use Aska\Permission;
use Aska\Site\Models\CompanyBranch;

class CompanyBranchPermission extends Permission {

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
    public function canUpdate(CompanyBranch $branches)
    {
        return $this->sessionUser->user()->hasPermission('site', 'all');
    }

    /**
     * Check if user has permission to delete this resource
     */
    public function canDelete(CompanyBranch $branches)
    {
        return $this->sessionUser->user()->hasPermission('site', 'all');
    }


} 