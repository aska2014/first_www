<?php namespace Cane\Observers;

use Cane\Models\Drive\Drive;
use Cane\UserSession;

class DriveObserver {

    /**
     * @param UserSession $userSession
     */
    public function __construct(UserSession $userSession)
    {
        $this->userSession = $userSession;
    }

    /**
     * @param Drive $drive
     */
    public function creating(Drive $drive)
    {
        // Associate user with this drive
        $drive->user()->associate($this->userSession->user());
    }
} 