<?php
use Aska\BMS\Models\Department;
use Aska\BMS\Models\DepartmentPermission;

class DepartmentSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        Department::truncate();
        DepartmentPermission::truncate();

        $administrative = Department::create(array(
            'name' => 'administrative'
        ));

        // Add all bms permissions to administrators
        foreach(Config::get('permissions.bms') as $permission) {

            $administrative->permissions()->create(array('name' => $permission['name']));
        }

        // Add all site permissions to administrators
        foreach(Config::get('permissions.site') as $permission) {

            $administrative->permissions()->create(array('name' => $permission['name']));
        }
    }

} 