<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call('DepartmentSeeder');
        $this->call('SettingsSeeder');
        $this->call('UserSeeder');
        $this->call('SliderSeeder');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}

}
