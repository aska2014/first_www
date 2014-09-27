<?php namespace Aska\Drive\Permissions;

use Aska\Drive\Models\Drive;
use Aska\Drive\Models\File;
use Aska\Permission;

class FilePermission extends Permission {

    /**
     * @param Drive $drive
     * @return bool
     */
    public function canCreate(Drive $drive)
    {
        return $this->sessionUser->user()->same($drive->user);
    }

    /**
     * @param Drive $drive
     * @param File $file
     * @return bool
     */
    public function canDelete(Drive $drive, File $file)
    {
        return $this->canCreate($drive);
    }

} 