<?php

use Drive\Drive;

class DriveController extends APIController {

    /**
     * @param Drive $drives
     * @param DriveValidator $driveValidator
     */
    public function __construct(Drive $drives, DriveValidator $driveValidator)
    {
        $this->drives = $drives;
        $this->driveValidator = $driveValidator;
    }

    /**
     * @return mixed
     */
    public function getMe()
    {
        return $this->me()->drives;
    }

    /**
     * Get my main drive
     * If I have no drives then create a new drive with my id and return it
     * @return mixed
     */
    public function getMain()
    {
        return $this->drives->getMain($this->me());
    }

    /**
     * Create new drive
     *
     * @return static
     */
    public function create()
    {
        $validator = $this->driveValidator->make(Input::all());

        if($validator->fails()) {

            return Response::make($validator->messages(), 400);
        }

        return $this->drives->create(Input::all());
    }

    /**
     * @param Drive $drive
     * @return \Drive\Drive
     */
    public function destroy(Drive $drive)
    {
        if(! $this->isThisMe($drive->user)) {

            App::abort(403, 'You don\'t have access on this drive.');
        }

        $drive->delete();

        return Response::make(['message' => 'You have deleted the drive successfully.']);
    }
}