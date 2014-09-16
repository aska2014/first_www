<?php namespace Cane\Permissions;

use Cane\Models\Drive\Drive;
use Cane\Models\Drive\File;

class FilePermission extends Permission {

    /**
     * @param Drive $drive
     * @return bool
     */
    public function canCreate(Drive $drive)
    {
        return $this->userSession->user()->same($drive->user);
    }

    /**
     * @param \Cane\Models\Drive\Drive $drive
     * @param \Cane\Models\Drive\File $file
     * @return bool
     */
    public function canDelete(Drive $drive, File $file)
    {
        return $this->canCreate($drive);
    }

} 