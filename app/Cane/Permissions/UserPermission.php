<?php namespace Cane\Permissions;

use Cane\Models\Membership\User;

class UserPermission extends Permission {

    /**
     * @param \Cane\Models\Membership\User $user
     * @return bool
     */
    public function canAccept(User $user)
    {
        return $this->userSession->user()->hasPermission('users', 'active');
    }

    /**
     * @param \Cane\Models\Membership\User $user
     * @return bool
     */
    public function canRefuse(User $user)
    {
        return $this->canAccept($user);
    }

    /**
     * Can auth user see inactive users.
     */
    public function canSeeInactive()
    {
        return $this->userSession->user()->hasPermission('users', 'active');
    }

    /**
     * Can update basic information including (full_name, profile_image)
     * @param \Cane\Models\Membership\User $user
     * @return bool
     */
    public function canUpdateBasicInfo(User $user)
    {
        return $this->userSession->user()->same($user);
    }

    /**
     * @param \Cane\Models\Membership\User $user
     * @return bool
     */
    public function canUpdateDepartments(User $user)
    {
        return $this->userSession->user()->hasPermission('users', 'departments');
    }

    /**
     * @param \Cane\Models\Membership\User $user
     * @return bool
     */
    public function canDelete(User $user)
    {
        // @todo use soft deleting instead
        return false;
    }
}