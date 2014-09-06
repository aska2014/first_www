<?php
class DepartmentSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        DB::table('departments')->delete();
        DB::table('department_permissions')->delete();

        $administrative = \Company\Department::create(array(
            'name' => 'administrative'
        ));
        \Company\Department::create(array(
            'name' => 'salesmen'
        ));
        \Company\Department::create(array(
            'name' => 'projects'
        ));
        \Company\Department::create(array(
            'name' => 'project'
        ));

        // Administrative permissions
        $administrative->permissions()->create(array('name' => 'users.*'));
        $administrative->permissions()->create(array('name' => 'permissions.*'));
        $administrative->permissions()->create(array('name' => 'projects.*'));
        $administrative->permissions()->create(array('name' => 'comments.*'));
        $administrative->permissions()->create(array('name' => 'stages.*'));
        $administrative->permissions()->create(array('name' => 'drives.*'));
        $administrative->permissions()->create(array('name' => 'files.*'));


        // Salesmen permissions

    }

} 