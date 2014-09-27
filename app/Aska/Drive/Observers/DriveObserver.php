<?php namespace Aska\Drive\Observers;

use Aska\Drive\Models\Drive;
use Aska\Membership\Auth\SessionUser;

class DriveObserver {

    /**
     * @param SessionUser $sessionUser
     */
    public function __construct(SessionUser $sessionUser)
    {
        $this->sessionUser = $sessionUser;
    }

    /**
     * @param Drive $drive
     */
    public function creating(Drive $drive)
    {
        // Associate user with this drive
        $drive->user()->associate($this->sessionUser->user());
    }
} 