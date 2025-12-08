<?php
// database/seeders/RoleSeeder.php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['nom' => 'Administrateur'],
            ['nom' => 'Modérateur'],
            ['nom' => 'Contributeur'],
            ['nom' => 'Lecteur'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}