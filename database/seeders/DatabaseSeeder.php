<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            TypeContenuSeeder::class,
            TypeMediaSeeder::class,
            LangueSeeder::class,
            RegionSeeder::class,
            UserSeeder::class,
            ContenuSeeder::class,
        ]);
    }
}