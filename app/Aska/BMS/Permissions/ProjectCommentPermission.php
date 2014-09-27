<?php namespace Aska\BMS\Permissions;

use Aska\BMS\Models\Project;
use Aska\BMS\Models\ProjectComment;
use Aska\Permission;

class ProjectCommentPermission extends Permission {

    /**
     * @param Project $project
     * @return bool
     */
    public function canSeeAll(Project $project)
    {
        return $project->isUserInTeam($this->sessionUser->user());
    }

    /**
     * @param Project $project
     * @param ProjectComment $projectComment
     * @return bool
     */
    public function canSee(Project $project, ProjectComment $projectComment)
    {
        return $this->canSeeAll($project);
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function canCreate(Project $project)
    {
        return $this->canSeeAll($project);
    }

    /**
     * @param Project $project
     * @param ProjectComment $comment
     * @return bool
     */
    public function canUpdate(Project $project, ProjectComment $comment)
    {
        return $this->sessionUser->user()->same($comment->user);
    }

    /**
     * @param Project $project
     * @param ProjectComment $comment
     * @return bool
     */
    public function canDelete(Project $project, ProjectComment $comment)
    {
        return $this->canUpdate($project, $comment);
    }
}