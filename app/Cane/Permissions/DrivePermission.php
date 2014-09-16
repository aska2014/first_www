<?php namespace Cane\Permissions;

use Cane\Models\Drive\Drive;

class DrivePermission extends Permission {

    /**
     * Check if user can see this drive.
     * Later we want to add feature to make this drive public or not but for now just check if he is the same user.
     *
     * @param Drive $drive
     * @return bool
     * @throws \Cane\Exceptions\AccessDeniedException
     */
    public function canSee(Drive $drive)
    {
        return $this->userSession->user()->same($drive->user);
    }
}