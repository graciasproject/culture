<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeMediaSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['nom' => 'Image'],
            ['nom' => 'Vidéo'],
            ['nom' => 'Audio'],
        ];

        // Utilise le bon nom de table
        DB::table('type_medias')->insert($types); // ← type_medias au pluriel
    }
}