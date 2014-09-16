<?php namespace Cane\Permissions;

use Cane\Models\Company\Project;

class ProjectPermission extends Permission {

    /**
     * @return bool
     */
    public function canSeeAll()
    {
        return $this->userSession->user()->hasPermission('projects', 'all');
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function canSee(Project $project)
    {
        // If you are working on this project then you can see it
        if($project->isUserInTeam($this->userSession->user())) return true;

        // If you are the creator
        if($this->userSession->user()->same($project->creator)) return true;

        // If you approved this project
        if($this->userSession->user()->same($project->approver)) return true;

        // If you have permission to see all projects
        if($this->userSession->user()->hasPermission('projects', 'all')) return true;

        return false;
    }

    /**
     * @return bool
     */
    public function canCreate()
    {
        return $this->userSession->user()->hasPermission('projects', 'create');
    }

    /**
     * @param \Cane\Models\Company\Project $project
     * @return bool
     */
    public function canUpdate(Project $project)
    {
        return $this->userSession->user()->hasPermission('projects', 'update');
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