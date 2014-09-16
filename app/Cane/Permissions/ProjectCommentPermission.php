<?php namespace Cane\Permissions;

use Cane\Models\Company\Project;
use Cane\Models\Company\ProjectComment;

class ProjectCommentPermission extends Permission {

    /**
     * @param Project $project
     * @return bool
     */
    public function canSeeAll(Project $project)
    {
        return $project->isUserInTeam($this->userSession->user());
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
     * @param \Cane\Models\Company\Project $project
     * @param ProjectComment $comment
     * @return bool
     */
    public function canUpdate(Project $project, ProjectComment $comment)
    {
        return $this->userSession->user()->same($comment->user);
    }

    /**
     * @param \Cane\Models\Company\Project $project
     * @param ProjectComment $comment
     * @return bool
     */
    public function canDelete(Project $project, ProjectComment $comment)
    {
        return $this->canUpdate($project, $comment);
    }
}