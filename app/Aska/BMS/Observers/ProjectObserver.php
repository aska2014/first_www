<?php namespace Aska\BMS\Observers;

use Aska\BMS\Models\Project;
use Aska\Membership\Auth\SessionUser;

class ProjectObserver {

    /**
     * @var SessionUser
     */
    protected $sessionUser;

    /**
     * @param SessionUser $sessionUser
     */
    public function __construct(SessionUser $sessionUser)
    {
        $this->sessionUser = $sessionUser;
    }

    /**
     * @param Project $project
     * @return bool
     */
    public function creating(Project $project)
    {
        $project->creator()->associate($this->sessionUser->user());
    }
}