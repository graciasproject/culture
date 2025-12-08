<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Langue;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::firstOrCreate(['nom' => 'Administrateur']);
        $contributeurRole = Role::firstOrCreate(['nom' => 'Contributeur']);
        $moderateurRole = Role::firstOrCreate(['nom' => 'Modérateur']);

        $users = [
            [
                'nom' => 'Dossou',
                'prenom' => 'Koffi',
                'email' => 'koffi.dossou@culturebenin.bj',
                'mot_de_passe' => Hash::make('password123'),
                'sexe' => 'M',
                'date_naissance' => '1985-06-15',
                'statut' => 'Actif',
                'photo' => 'default.png',
                'id_langue' => Langue::where('code_langue', 'fon')->first()->id,
                'id_role' => $adminRole->id,
            ],
            [
                'nom' => 'Adékambi',
                'prenom' => 'Mariam',
                'email' => 'mariam.adekami@culturebenin.bj',
                'mot_de_passe' => Hash::make('password123'),
                'sexe' => 'F',
                'date_naissance' => '1990-03-22',
                'statut' => 'Actif',
                'photo' => 'default.png',
                'id_langue' => Langue::where('code_langue', 'yor')->first()->id,
                'id_role' => $moderateurRole->id,
            ],
            [
                'nom' => 'Sègbo',
                'prenom' => 'Jean',
                'email' => 'jean.segbo@culturebenin.bj',
                'mot_de_passe' => Hash::make('password123'),
                'sexe' => 'M',
                'date_naissance' => '1988-11-08',
                'statut' => 'Actif',
                'photo' => 'default.png',
                'id_langue' => Langue::where('code_langue', 'fon')->first()->id,
                'id_role' => $contributeurRole->id,
            ],
            [
                'nom' => 'Bakary',
                'prenom' => 'Aïchatou',
                'email' => 'aichatou.bakary@culturebenin.bj',
                'mot_de_passe' => Hash::make('password123'),
                'sexe' => 'F',
                'date_naissance' => '1992-07-30',
                'statut' => 'Actif',
                'photo' => 'default.png',
                'id_langue' => Langue::where('code_langue', 'bba')->first()->id,
                'id_role' => $contributeurRole->id,
            ],
            [
                'nom' => 'Tchibozo',
                'prenom' => 'Marc',
                'email' => 'marc.tchibozo@culturebenin.bj',
                'mot_de_passe' => Hash::make('password123'),
                'sexe' => 'M',
                'date_naissance' => '1987-12-14',
                'statut' => 'Actif',
                'photo' => 'default.png',
                'id_langue' => Langue::where('code_langue', 'fon')->first()->id,
                'id_role' => $contributeurRole->id,
            ],

            [
                'nom' => 'Comlan',
                'prenom' => 'Maurice',
                'email' => 'maurice.comlan@uac.bj',
                'mot_de_passe' => Hash::make('Eneam123'),
                'sexe' => 'M',
                'date_naissance' => '1985-06-15',
                'statut' => 'Actif',
                'photo' => 'default.png',
                'id_langue' => Langue::where('code_langue', 'fon')->first()->id,
                'id_role' => $adminRole->id,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
