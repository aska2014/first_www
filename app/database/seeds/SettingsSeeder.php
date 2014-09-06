<?php
class SettingsSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        DB::table('settings')->delete();

        Settings::create(array(
            'main_password' => 'firstchoice2014'
        ));
    }

} 