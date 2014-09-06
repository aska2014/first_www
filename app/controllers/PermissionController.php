<?php

class PermissionController extends APIController {

    /**
     * @param \Permission\Permission $permissions
     */
    public function __construct(\Permission\Permission $permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @param \Company\Department $department
     * @return mixed
     */
    public function getByDepartment(\Company\Department $department)
    {
        return $department->permissions;
    }

    /**
     * @param \Company\Department $department
     * @return mixed
     */
    public function updateDepartment(\Company\Department $department)
    {
        $department->setPermissions(Input::get('permissions'));

        return Response::make(['message' => 'Permissions updated successfully']);
    }

    /**
     * @return mixed
     */
    public function getMe()
    {
        return $this->me()->permissions;
    }
} 