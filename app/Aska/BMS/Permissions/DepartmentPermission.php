<?php namespace Aska\BMS\Permissions;

use Aska\BMS\Models\Department;
use Aska\Permission;

class DepartmentPermission extends Permission {

    /**
     * @return bool
     */
    public function canCreate()
    {
        return $this->sessionUser->user()->hasPermission('departments', 'create');
    }

    /**
     * @param Department $department
     * @return bool
     */
    public function canUpdate(Department $department)
    {
        return $this->canCreate();
    }

    /**
     * @param Department $department
     * @return bool
     */
    public function canUpdatePermissions(Department $department)
    {
        return $this->sessionUser->user()->hasPermission('departments', 'permissions');
    }

    /**
     * @param Department $department
     * @return bool
     */
    public function canUpdateUsers(Department $department)
    {
        return $this->sessionUser->user()->hasPermission('users', 'departments');
    }

    /**
     * @param Department $department
     * @return bool
     */
    public function canDelete(Department $department)
    {
        return $this->canCreate();
    }
}