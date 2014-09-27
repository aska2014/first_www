<?php

use Aska\App\Settings;

class SettingsSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        Settings::truncate();

        Settings::create(array(
            'main_password' => 'firstchoice2014'
        ));
    }

} 