<?php
// database/seeders/LangueSeeder.php

namespace Database\Seeders;

use App\Models\Langue;
use Illuminate\Database\Seeder;

class LangueSeeder extends Seeder
{
    public function run()
    {
        $langues = [
            // Langues officielles et nationales
            ['nom_langue' => 'Français',  'code_langue' => 'fr', 'description' => 'Langue officielle du Bénin'],
            ['nom_langue' => 'Fon',       'code_langue' => 'fon', 'description' => 'Langue la plus parl\u00e9e du sud du B\u00e9nin'],
            ['nom_langue' => 'Yoruba',    'code_langue' => 'yor', 'description' => 'Langue parl\u00e9e dans le sud-ouest du B\u00e9nin'],
            ['nom_langue' => 'Gun (Goun)','code_langue' => 'guw', 'description' => 'Langue Gbe parl\u00e9e \u00e0 Porto-Novo (Ou\u00e9m\u00e9)'],
            ['nom_langue' => 'Bariba',    'code_langue' => 'bba', 'description' => 'Langue principale du nord du B\u00e9nin (Borgou)'],
            ['nom_langue' => 'Dendi',     'code_langue' => 'ddn', 'description' => 'Langue parl\u00e9e dans le nord-est (Malanville)'],
            ['nom_langue' => 'Adja',      'code_langue' => 'ajg', 'description' => 'Langue du sud-ouest du B\u00e9nin'],
            ['nom_langue' => 'Yom',       'code_langue' => 'pil', 'description' => 'Langue parl\u00e9e dans le nord-ouest (Donga)'],
            ['nom_langue' => 'Ayizo',     'code_langue' => 'ayb', 'description' => 'Langue Gbe parl\u00e9e dans le centre (Collines)'],

            // Autres langues majeures
            ['nom_langue' => 'Mina (G\u00e9n)',      'code_langue' => 'gej', 'description' => 'Langue c\u00f4ti\u00e8re parl\u00e9e \u00e0 Grand-Popo'],
            ['nom_langue' => 'Waci (W\u00e9m\u00e8)',  'code_langue' => 'wci', 'description' => 'Langue Gbe du sud-ouest (Mono)'],
            ['nom_langue' => 'Tofin',              'code_langue' => 'tfi', 'description' => 'Langue Gbe parl\u00e9e \u00e0 S\u00f4-Ava (lac Nokou\u00e9)'],
            ['nom_langue' => 'Sahou\u00e9 (Saxw\u00e8)','code_langue' => 'sxw', 'description' => 'Langue Gbe parl\u00e9e dans le centre (Collines)'],
            ['nom_langue' => 'Lokpa (Lukpa)',      'code_langue' => 'dop', 'description' => 'Langue Gur parl\u00e9e dans l\'Atacora (nord-ouest)'],
            ['nom_langue' => 'Mahi (Maxi)',        'code_langue' => 'mxl', 'description' => 'Langue Gbe parl\u00e9e dans l\'Atlantique (centre)'],
            ['nom_langue' => 'Nateni',             'code_langue' => 'ntm', 'description' => 'Langue parl\u00e9e dans l\'Atacora (Natitingou)'],
            ['nom_langue' => 'Kotafon',            'code_langue' => 'kqk', 'description' => 'Langue Gbe parl\u00e9e dans le sud-ouest (Mono)'],
            ['nom_langue' => 'Tammari (Ditammari)', 'code_langue' => 'tbz', 'description' => 'Langue Gur parl\u00e9e dans l\'Atacora (Atacora)'],
            ['nom_langue' => 'Fulfulde',           'code_langue' => 'fue', 'description' => 'Langue peule parl\u00e9e par les \u00e9leveurs au nord'],
        ];

        foreach ($langues as $langue) {
            Langue::create($langue);
        }
    }
}
