<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;

class createAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('provaprova');
        $user->save();

        $adminRole = Role::where('name', 'Admin')->first();

        $user->attachRole($adminRole);

    }
}
