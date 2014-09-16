<?php namespace Cane\Observers;

use Cane\Exceptions\AccessDeniedException;
use Cane\Models\Company\Project;
use Cane\UserSession;

class ProjectObserver {

    /**
     * @var UserSession
     */
    protected $userSession;

    /**
     * @param UserSession $userSession
     */
    public function __construct(UserSession $userSession)
    {
        $this->userSession = $userSession;
    }

    /**
     * @param Project $project
     * @throws \Cane\Exceptions\AccessDeniedException
     * @return bool
     */
    public function creating(Project $project)
    {
        $project->creator()->associate($this->userSession->user());
    }
}