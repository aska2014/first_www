<?php

use Cane\Models\Membership\User;
use Cane\Permissions\UserPermission;
use Cane\Validators\UserValidator;

class UserController extends BaseController {

    /**
     * @param User $users
     * @param UserValidator $userValidator
     * @param Cane\Permissions\UserPermission $userPermission
     * @param Cane\UserSession $userSession
     */
    public function __construct(User $users, UserValidator $userValidator, UserPermission $userPermission, \Cane\UserSession $userSession)
    {
        $this->users = $users;
        $this->userValidator = $userValidator;
        $this->userPermission = $userPermission;
        $this->userSession = $userSession;
    }

    /**
     * Get all users
     */
    public function index()
    {
        $query = $this->users;

        // If with inactive is given and auth user can see inactive then don't call active query
        if (! (Input::has('with_inactive') && $this->userPermission->canSeeInactive())) {

            $query = $query->active();
        }

        if(Input::has('department_id')) {

            $query = $query->byDepartmentId(Input::get('department_id'));
        }

        return $query->get();
    }

    /**
     * Show user by id
     */
    public function show(User $user)
    {
        // If user not active and auth user can't see inactive
        if(! $user->active && ! $this->userPermission->canSeeInactive()) {

            $this->noAccess("You can't see inactive users");
        }

        return $user;
    }

    /**
     * Return current user in session.
     */
    public function session()
    {
        return $this->userSession->user()->withPermissions();
    }

    /**
     * @return mixed
     */
    public function register()
    {
        $this->userValidator->validateOrFail($data = Input::all());

        $user = $this->users->create($data);

        return $user;
    }

    /**
     * Update user information
     *
     * @param Cane\Models\Membership\User $user
     * @return static
     */
    public function update(User $user)
    {
        // Only the following attributes are allowed to be updated
        if(Input::has('full_name') && $this->userPermission->canUpdateBasicInfo($user)) {

            $user->full_name = Input::get('full_name');
        }
        if(Input::has('profile_image') && $this->userPermission->canUpdateBasicInfo($user)) {

            $user->profile_image = Input::get('profile_image');
        }

        if(Input::has('departments') && $this->userPermission->canUpdateDepartments($user)) {

            $user->departments = Input::get('departments');
        }

        $user->save();

        return $user;
    }

    /**
     * Accept user
     */
    public function accept(User $user)
    {
        if(! $this->userPermission->canAccept($user)) {

            $this->noAccess("You can't accept users");
        }

        $user->accept();

        return ['message' => 'User accepted successfully'];
    }

    /**
     * Refuse user
     */
    public function refuse(User $user)
    {
        if(! $this->userPermission->canRefuse($user)) {

            $this->noAccess("You can't refuse users");
        }

        $user->refuse();

        return ['message' => 'User refused successfully'];
    }

    /**
     * Soft delete a user by id
     */
    public function destroy(User $user)
    {
        if(! $this->userPermission->canDelete($user)) {

            $this->noAccess("You can't delete users");
        }

        $user->delete();

        return ['message' => 'User deleted successfully'];
    }
}