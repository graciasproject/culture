<?php
// database/seeders/TypeContenuSeeder.php

namespace Database\Seeders;

use App\Models\TypeContenu;
use Illuminate\Database\Seeder;

class TypeContenuSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['nom' => 'Histoire et Légende'],
            ['nom' => 'Recette Culinaire'],
            ['nom' => 'Tradition et Rite'],
            ['nom' => 'Art et Artisanat'],
            ['nom' => 'Musique et Danse'],
            ['nom' => 'Proverbe et Sagesse'],
            ['nom' => 'Patrimoine Architectural'],
            ['nom' => 'Costume Traditionnel'],
            ['nom' => 'Médecine Traditionnelle'],
            ['nom' => 'Festival et Fête'],
        ];

        foreach ($types as $type) {
            TypeContenu::create($type);
        }
    }
}