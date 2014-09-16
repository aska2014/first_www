<?php namespace Cane\Permissions;

use Cane\Exceptions\AccessDeniedException;
use Cane\Models\Company\Department;

class DepartmentPermission extends Permission {

    /**
     * @return bool
     */
    public function canCreate()
    {
        return $this->userSession->user()->hasPermission('departments', 'create');
    }

    /**
     * @param \Cane\Models\Company\Department $department
     * @return bool
     */
    public function canUpdate(Department $department)
    {
        return $this->canCreate();
    }

    /**
     * @param \Cane\Models\Company\Department $department
     * @return bool
     */
    public function canUpdatePermissions(Department $department)
    {
        return $this->userSession->user()->hasPermission('departments', 'permissions');
    }

    /**
     * @param Department $department
     * @return bool
     */
    public function canUpdateUsers(Department $department)
    {
        return $this->userSession->user()->hasPermission('users', 'departments');
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