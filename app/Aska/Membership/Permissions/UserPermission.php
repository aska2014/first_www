<?php namespace Aska\Membership\Permissions;

use Aska\Membership\Models\User;
use Aska\Permission;

class UserPermission extends Permission {

    /**
     * @param User $user
     * @return bool
     */
    public function canAccept(User $user)
    {
        // You can't accept yourself
        if($this->sessionUser->user()->same($user)) {
            return false;
        }

        return $this->sessionUser->user()->hasPermission('users', 'active');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function canRefuse(User $user)
    {
        // You can't refuse yourself
        if($this->sessionUser->user()->same($user)) {
            return false;
        }

        return $this->canAccept($user);
    }

    /**
     * Can auth user see inactive users.
     */
    public function canSeeInactive()
    {
        return $this->sessionUser->user()->hasPermission('users', 'active');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function canUpdateBasicInfo(User $user)
    {
        return $this->sessionUser->user()->same($user);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function canUpdateDepartments(User $user)
    {
        return $this->sessionUser->user()->hasPermission('users', 'departments');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function canDelete(User $user)
    {
        // @todo use soft deleting instead
        return false;
    }
}