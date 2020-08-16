<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

/**
 * Class RolesTableSeeder
 */
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guest_user = new Role();
        $guest_user->name = 'Guest';
        $guest_user->description = 'Guest';
        $guest_user->save();

        $role_user = new Role();
        $role_user->name = 'User';
        $role_user->description = 'User';
        $role_user->save();

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'User Admin';
        $role_admin->save();
    }
}