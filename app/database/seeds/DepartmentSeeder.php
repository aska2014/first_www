<?php
use Cane\Models\Company\Department;
use Cane\Models\Permission\DepartmentPermission;

class DepartmentSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        Department::truncate();
        DepartmentPermission::truncate();

        $administrative = Department::create(array(
            'name' => 'administrative'
        ));

        // Add all permissions to administrators
        foreach(Config::get('permissions') as $permission) {

            $administrative->permissions()->create(array('name' => $permission['name']));
        }
    }

} 