<?php


use Aska\Membership\Models\User;

class UserSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        User::truncate();
    }

} 