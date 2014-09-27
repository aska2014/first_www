<?php namespace Aska\Drive\Permissions;

use Aska\Drive\Models\Drive;
use Aska\Permission;

class DrivePermission extends Permission {

    /**
     * Check if user can see this drive.
     * Later we want to add feature to make this drive public or not but for now just check if he is the same user.
     *
     * @param Drive $drive
     * @return bool
     */
    public function canSee(Drive $drive)
    {
        return $this->sessionUser->user()->same($drive->user);
    }
}