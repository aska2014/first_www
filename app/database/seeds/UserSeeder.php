<?php

use Cane\Models\Membership\User;

class UserSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        User::truncate();
    }

} 