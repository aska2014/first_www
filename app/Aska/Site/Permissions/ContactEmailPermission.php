<?php namespace Aska\Site\Permissions;

use Aska\Permission;
use Aska\Site\Models\ContactEmail;

class ContactEmailPermission extends Permission {

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
    public function canUpdate(ContactEmail $contactEmail)
    {
        return $this->sessionUser->user()->hasPermission('site', 'all');
    }

    /**
     * Check if user has permission to delete this resource
     */
    public function canDelete(ContactEmail $contactEmail)
    {
        return $this->sessionUser->user()->hasPermission('site', 'all');
    }
    
    

} 