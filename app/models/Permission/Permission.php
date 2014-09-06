<?php namespace Permission;

use Illuminate\Database\Eloquent\Collection;
use Membership\User;

class Permission {

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Collection
     */
    protected $permissions;

    /**
     * @param User $user
     */
    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    /**
     * Check if user has this permission
     *
     * @param $permissionName
     * @return bool
     */
    public function has($permissionName)
    {
        $permissions = $this->getAll();

        foreach($permissions as $permission)
        {
            if($permission->check($permissionName))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $permissions
     * @return bool
     */
    public function hasAll($permissions)
    {
        foreach($permissions as $permission)
        {
            if(! $this->has($permission)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return Collection
     */
    public function getAll()
    {
        return $this->user->permissions;
    }
}