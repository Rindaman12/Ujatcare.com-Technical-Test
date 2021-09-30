<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    //We create a seeder for the user with all the relevant data

    public function run()
    {
        $admin = new User;
        $admin->username = 'lpena';
        $admin->password = bcrypt('12345678');
        $admin->remember_token = Str::random(10);
        $admin->save();
    }
}
