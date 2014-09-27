<?php namespace SharedApi;

use Aska\Drive\Models\Drive;
use Aska\Drive\Models\File;
use Aska\Drive\Permissions\DrivePermission;
use Aska\Drive\Permissions\FilePermission;
use Aska\Drive\Validators\FileValidator;
use BaseController;
use Response, Input;

class FileController extends BaseController {

    /**
     * @param File $files
     * @param FileValidator $fileValidator
     * @param Drive $drives
     * @param DrivePermission $drivePermission
     * @param FilePermission $filePermission
     */
    public function __construct(File $files, FileValidator $fileValidator, Drive $drives,
                                DrivePermission $drivePermission, FilePermission $filePermission)
    {
        $this->files = $files;
        $this->drives = $drives;
        $this->fileValidator = $fileValidator;
        $this->drivePermission = $drivePermission;
        $this->filePermission = $filePermission;
    }

    /**
     * @param Drive $drive
     * @return mixed
     */
    public function index(Drive $drive)
    {
        if(! $this->drivePermission->canSee($drive)) {

            $this->forbidden("You can't access this drive");
        }

        return $drive->files;
    }

    /**
     * @param Drive $drive
     * @return File
     */
    public function store(Drive $drive)
    {
        if(! $this->filePermission->canCreate($drive)) {

            $this->forbidden("You can't create files in this drive");
        }

        $this->fileValidator->validateOrFail($data = Input::all());

        return $this->files->uploadAndCreate($drive, Input::file('file'));
    }

    /**
     * Detach file from my drive then check if this file doesn't exist in other drives to permanently delete it
     *
     * @param Drive $drive
     * @param File $file
     * @return mixed
     */
    public function destroy(Drive $drive, File $file)
    {
        if(! $this->filePermission->canDelete($drive, $file)) {

            $this->forbidden("You can't delete files from this drive");
        }

        $file->drives()->detach($drive);

        if($file->drives()->count() == 0) {

            $file->delete();
        }

        return Response::make(['message' => 'File deleted successfully.']);
    }
}