<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'Super Admin')->firstorfail();
User::create([
    'name' => 'Super Admin',
    'email' => 'zain@superadmin.com',
    'password' => Hash::make('password'), // Change this to a secure password
    'role_id' => $role->id,

    'created_at' => now(),
    'updated_at' => now(),

]);

    }
}
