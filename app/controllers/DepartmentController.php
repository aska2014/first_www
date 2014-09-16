<?php
use Cane\Models\Company\Department;
use Cane\Permissions\DepartmentPermission;
use Cane\Permissions\UserPermission;
use Cane\Validators\DepartmentValidator;

class DepartmentController extends BaseController {

    /**
     * @param Department $departments
     * @param DepartmentValidator $departmentValidator
     * @param Cane\Permissions\UserPermission $userPermission
     * @param Cane\Permissions\DepartmentPermission $departmentPermission
     */
    public function __construct(Department $departments, DepartmentValidator $departmentValidator,
                                UserPermission $userPermission, DepartmentPermission $departmentPermission)
    {
        $this->departments = $departments;
        $this->departmentValidator = $departmentValidator;
        $this->userPermission = $userPermission;
        $this->departmentPermission = $departmentPermission;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return $this->departments->all();
    }

    /**
     * @param Cane\Models\Company\Department $department
     * @return \Illuminate\Support\Collection|static
     */
    public function show(Department $department)
    {
        return $department->load('users', 'permissions');
    }

    /**
     * Store new resource
     */
    public function store()
    {
        if(! $this->departmentPermission->canCreate()) {

            $this->noAccess("You can't create department");
        }

        $this->departmentValidator->validateOrFail($data = Input::all());

        return $this->departments->create($data);
    }

    /**
     * Update resource
     */
    public function update(Department $department)
    {
        if(! $this->departmentPermission->canUpdate($department)) {

            $this->noAccess("You can't update this department");
        }

        $department->update(Input::all());

        if(Input::has('users') && $this->departmentPermission->canUpdateUsers($department)) {

            // @todo
            // If you don't have access to update user departments
            // Handle this probably by sending some notification to user along with the success message
            $department->setUsers(Input::get('users'));
        }

        if(Input::has('permissions') && $this->departmentPermission->canUpdatePermissions($department)) {

            // @todo
            // If you don't have access to update department permissionss
            // Handle this probably by sending some notification to user along with the success message
            $department->setPermissions(Input::get('permissions'));
        }

        return $department->load('permissions', 'users');
    }

    /**
     * @param Cane\Models\Company\Department $department
     * @return mixed
     */
    public function destroy(Department $department)
    {
        if(! $this->departmentPermission->canDelete($department)) {

            $this->noAccess("You can't delete this department");
        }

        $department->delete();

        return Response::make(['message' => 'Department deleted successfully']);
    }
}