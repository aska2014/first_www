<?php

use Cane\Models\Drive\Drive;
use Cane\Models\Drive\File;
use Cane\Permissions\DrivePermission;
use Cane\Validators\FileValidator;

class FileController extends BaseController {

    /**
     * @param File $files
     * @param FileValidator $fileValidator
     * @param Drive $drives
     * @param Cane\Permissions\DrivePermission $drivePermission
     * @param Cane\Permissions\FilePermission $filePermission
     */
    public function __construct(File $files, FileValidator $fileValidator, Drive $drives,
                                DrivePermission $drivePermission, \Cane\Permissions\FilePermission $filePermission)
    {
        $this->files = $files;
        $this->drives = $drives;
        $this->fileValidator = $fileValidator;
        $this->drivePermission = $drivePermission;
        $this->filePermission = $filePermission;
    }

    /**
     * @param Cane\Models\Drive\Drive $drive
     * @return mixed
     */
    public function index(Drive $drive)
    {
        if(! $this->drivePermission->canSee($drive)) {

            $this->noAccess("You can't access this drive");
        }

        return $drive->files;
    }

    /**
     * @param Cane\Models\Drive\Drive $drive
     * @return File
     */
    public function store(Drive $drive)
    {
        if(! $this->filePermission->canCreate($drive)) {

            $this->noAccess("You can't create files in this drive");
        }

        $this->fileValidator->validateOrFail($data = Input::all());

        return $this->files->uploadAndCreate($drive, Input::file('file'));
    }

    /**
     * Detach file from my drive then check if this file doesn't exist in other drives to permanently delete it
     *
     * @param Cane\Models\Drive\Drive $drive
     * @param Cane\Models\Drive\File $file
     * @return mixed
     */
    public function destroy(Drive $drive, File $file)
    {
        if(! $this->filePermission->canDelete($drive, $file)) {

            $this->noAccess("You can't delete files from this drive");
        }

        $file->drives()->detach($drive);

        if($file->drives()->count() == 0) {

            $file->delete();
        }

        return Response::make(['message' => 'File deleted successfully.']);
    }
}