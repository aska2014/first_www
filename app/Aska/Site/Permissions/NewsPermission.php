<?php namespace Aska\Site\Permissions;

use Aska\Permission;
use Aska\Site\Models\News;

class NewsPermission extends Permission {

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
    public function canUpdate(News $news)
    {
        return $this->sessionUser->user()->hasPermission('site', 'all');
    }

    /**
     * Check if user has permission to delete this resource
     */
    public function canDelete(News $news)
    {
        return $this->sessionUser->user()->hasPermission('site', 'all');
    }


} 