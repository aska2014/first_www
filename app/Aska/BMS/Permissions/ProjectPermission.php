<?php namespace Aska\BMS\Permissions;

use Aska\BMS\Models\Project;
use Aska\Permission;

class ProjectPermission extends Permission {

    /**
     * @return bool
     */
    public function canSeeAll()
    {
        return $this->sessionUser->user()->hasPermission('projects', 'all');
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function canSee(Project $project)
    {
        // If you are working on this project then you can see it
        if($project->isUserInTeam($this->sessionUser->user())) return true;

        // If you are the creator
        if($this->sessionUser->user()->same($project->creator)) return true;

        // If you approved this project
        if($this->sessionUser->user()->same($project->approver)) return true;

        // If you have permission to see all projects
        if($this->sessionUser->user()->hasPermission('projects', 'all')) return true;

        return false;
    }

    /**
     * @return bool
     */
    public function canCreate()
    {
        return $this->sessionUser->user()->hasPermission('projects', 'create');
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function canUpdate(Project $project)
    {
        return $this->sessionUser->user()->hasPermission('projects', 'update');
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function canDelete(Project $project)
    {
        return $this->canCreate();
    }
}