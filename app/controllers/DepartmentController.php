<?php
class DepartmentController extends APIController {

    /**
     * @param \Company\Department $departments
     */
    public function __construct(\Company\Department $departments)
    {
        $this->departments = $departments;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->departments->all();
    }

} 