<?php namespace Cane\Observers;

use Cane\Models\Company\Project;
use Cane\Models\Company\ProjectComment;
use Cane\UserSession;

class ProjectCommentObserver {

    /**
     * @var \Cane\Models\Company\Project
     */
    protected $projects;

    /**
     * @var UserSession
     */
    protected $userSession;

    /**
     * @param \Cane\Models\Company\Project $projects
     * @param UserSession $userSession
     */
    public function __construct(Project $projects, UserSession $userSession)
    {
        $this->projects = $projects;
        $this->userSession = $userSession;
    }

    /**
     * @param ProjectComment $comment
     * @throws \Cane\Exceptions\AccessDeniedException
     * @return bool
     */
    public function creating(ProjectComment $comment)
    {
        $comment->user()->associate($this->userSession->user());
    }
}