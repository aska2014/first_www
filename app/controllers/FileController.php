<?php

use Drive\Drive;
use Drive\File;

class FileController extends APIController {

    /**
     * @param File $files
     * @param FileValidator $fileValidator
     * @param Drive $drives
     */
    public function __construct(File $files, FileValidator $fileValidator, Drive $drives)
    {
        $this->files = $files;
        $this->drives = $drives;
        $this->fileValidator = $fileValidator;
    }

    /**
     * @param Drive $drive
     * @return mixed
     */
    public function getByDrive(Drive $drive)
    {
        $this->mustOwnDrive($drive);

        return $drive->files;
    }

    /**
     * @param Drive $drive
     * @return File
     */
    public function uploadToDrive(Drive $drive)
    {
        $basePath = public_path('drives');
        $baseUrl = URL::to('public/drives');

        $file = $this->files->uploadAndCreate($drive, $basePath, $baseUrl, Input::file('file'));

        return $file;
    }

    /**
     * @return File
     */
    public function uploadToMainDrive()
    {
        return $this->uploadToDrive($this->drives->getMain($this->me()));
    }

    /**
     * @param Drive $drive
     * @return mixed
     */
    public function getDriveImages(Drive $drive)
    {
        $this->mustOwnDrive($drive);

        return $drive->getImages();
    }

    /**
     * @param Drive $drive
     * @return mixed
     */
    public function getDriveDocuments(Drive $drive)
    {
        $this->mustOwnDrive($drive);

        return $drive->getDocuments();
    }

    /**
     * Delete file from drive only and no other place is affected.
     *
     * @param Drive $drive
     * @param File $file
     */
    public function destroy(Drive $drive, File $file)
    {
        $this->mustOwnDrive($drive);

        if(! $drive->hasFile($file)) {

            return Response::make(['message' => 'This file doesn\'t exist in this drive'], 400);
        }

        $file->delete();

        return Response::make(['message' => 'File deleted successfully.']);
    }

    /**
     * @param Drive $drive
     */
    protected function mustOwnDrive(Drive $drive)
    {
        if(! $this->isThisMe($drive->user)) {

            App::abort(403, 'You don\'t have access on this drive.');
        }
    }
} 