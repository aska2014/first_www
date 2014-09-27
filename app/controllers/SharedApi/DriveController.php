<?php namespace SharedApi;

use Aska\Drive\Models\Drive;
use Aska\Drive\Permissions\DrivePermission;
use Aska\Drive\Validators\DriveValidator;
use Aska\Membership\Auth\SessionUser;
use BaseController;
use Input, Response;

class DriveController extends BaseController{

    /**
     * @param Drive $drives
     * @param DriveValidator $driveValidator
     * @param SessionUser $sessionUser
     * @param DrivePermission $drivePermission
     */
    public function __construct(Drive $drives, DriveValidator $driveValidator, SessionUser $sessionUser, DrivePermission $drivePermission)
    {
        $this->drives = $drives;
        $this->driveValidator = $driveValidator;
        $this->sessionUser = $sessionUser;
        $this->drivePermission = $drivePermission;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->drives->byUser($this->sessionUser->user())->get();
    }

    /**
     * @return mixed
     */
    public function main()
    {
        return $this->drives->getMain($this->sessionUser->user())->load('files');
    }

    /**
     * @param Drive $drive
     * @return \Illuminate\Support\Collection|static
     */
    public function show(Drive $drive)
    {
        if(! $this->drivePermission->canSee($drive)) {

            $this->forbidden("You can't access this drive");
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