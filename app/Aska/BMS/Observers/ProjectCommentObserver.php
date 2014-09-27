<?php namespace Aska\BMS\Observers;

use Aska\BMS\Models\Project;
use Aska\BMS\Models\ProjectComment;
use Aska\Membership\Auth\SessionUser;

class ProjectCommentObserver {

    /**
     * @var Project
     */
    protected $projects;

    /**
     * @var SessionUser
     */
    protected $sessionUser;

    /**
     * @param Project $projects
     * @param SessionUser $sessionUser
     */
    public function __construct(Project $projects, SessionUser $sessionUser)
    {
        $this->projects = $projects;
        $this->sessionUser = $sessionUser;
    }

    /**
     * @param ProjectComment $comment
     * @return bool
     */
    public function creating(ProjectComment $comment)
    {
        $comment->user()->associate($this->sessionUser->user());
    }
}