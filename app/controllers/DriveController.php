<?php

use Cane\Models\Drive\Drive;
use Cane\Permissions\DrivePermission;
use Cane\Validators\DriveValidator;

class DriveController extends BaseController{

    /**
     * @param Drive $drives
     * @param DriveValidator $driveValidator
     * @param Cane\UserSession $userSession
     * @param Cane\Permissions\DrivePermission $drivePermission
     */
    public function __construct(Drive $drives, DriveValidator $driveValidator, \Cane\UserSession $userSession, DrivePermission $drivePermission)
    {
        $this->drives = $drives;
        $this->driveValidator = $driveValidator;
        $this->userSession = $userSession;
        $this->drivePermission = $drivePermission;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->drives->byUser($this->userSession->user())->get();
    }

    /**
     * @return mixed
     */
    public function main()
    {
        return $this->drives->getMain($this->userSession->user())->load('files');
    }

    /**
     * @param Cane\Models\Drive\Drive $drive
     * @return \Illuminate\Support\Collection|static
     */
    public function show(Drive $drive)
    {
        if(! $this->drivePermission->canSee($drive)) {

            $this->noAccess("You can't access this drive");
        }

        return $drive->load('files');
    }

    /**
     * Create new drive
     *
     * @return static
     */
    public function store()
    {
        $this->driveValidator->validateOrFail($data = Input::all());

        return $this->drives->create(Input::all());
    }
}