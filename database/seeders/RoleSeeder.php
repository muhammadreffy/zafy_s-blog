<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerRole = Role::create([
            'name' => 'owner',
        ]);

        $writerRole = Role::create([
            'name' => 'writer',
        ]);

        $userOwner = User::create([
            'name' => 'Muhammad Reffy Syahnata',
            'username' => 'muhammadreffy',
            'email' => 'syahnataa@gmail.com',
            'avatar' => 'images/default-avatar.png',
            'password' => Hash::make('@Reffy1234'),
        ]);

        $userOwner->assignRole($ownerRole);
    }
}
