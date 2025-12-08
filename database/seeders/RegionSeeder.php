<?php
// database/seeders/RegionSeeder.php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $communes = [
            // Département de l'Atlantique
            ['nom_region' => 'Abomey-Calavi', 'description' => 'Commune dynamique abritant l\'Université d\'Abomey-Calavi', 'population' => 950000, 'superficie' => 650, 'localisation' => 'Sud'],
            ['nom_region' => 'Allada', 'description' => 'Royaume historique d\'Allada, berceau de la culture Aja', 'population' => 220000, 'superficie' => 380, 'localisation' => 'Sud'],
            ['nom_region' => 'Ouidah', 'description' => 'Ville historique de la traite négrière et du vodoun', 'population' => 150000, 'superficie' => 364, 'localisation' => 'Sud'],
            ['nom_region' => 'Sô-Ava', 'description' => 'Commune lacustre sur le lac Nokoué', 'population' => 90000, 'superficie' => 118, 'localisation' => 'Sud'],
            ['nom_region' => 'Toffo', 'description' => 'Commune agricole réputée pour sa production d\'ananas', 'population' => 110000, 'superficie' => 450, 'localisation' => 'Sud'],
            ['nom_region' => 'Tori-Bossito', 'description' => 'Commune rurale aux paysages verdoyants', 'population' => 100000, 'superficie' => 312, 'localisation' => 'Sud'],
            ['nom_region' => 'Zè', 'description' => 'Commune agricole et artisanale', 'population' => 130000, 'superficie' => 600, 'localisation' => 'Sud'],

            // Département du Littoral
            ['nom_region' => 'Cotonou', 'description' => 'Capitale économique du Bénin, ville portuaire', 'population' => 820000, 'superficie' => 79, 'localisation' => 'Sud'],

            // Département du Borgou
            ['nom_region' => 'Bembèrèkè', 'description' => 'Ville carrefour du Borgou', 'population' => 180000, 'superficie' => 3348, 'localisation' => 'Nord-Est'],
            ['nom_region' => 'Kalalé', 'description' => 'Commune frontalière avec le Nigeria', 'population' => 160000, 'superficie' => 3586, 'localisation' => 'Nord-Est'],
            ['nom_region' => 'N\'Dali', 'description' => 'Commune agricole et d\'élevage', 'population' => 120000, 'superficie' => 2760, 'localisation' => 'Nord-Est'],
            ['nom_region' => 'Nikki', 'description' => 'Ancien royaume Bariba, riche en histoire', 'population' => 200000, 'superficie' => 3200, 'localisation' => 'Nord-Est'],
            ['nom_region' => 'Parakou', 'description' => 'Plus grande ville du Nord-Bénin, carrefour commercial', 'population' => 350000, 'superficie' => 441, 'localisation' => 'Nord'],
            ['nom_region' => 'Pèrèrè', 'description' => 'Commune rurale aux traditions préservées', 'population' => 90000, 'superficie' => 2042, 'localisation' => 'Nord-Est'],
            ['nom_region' => 'Sinendé', 'description' => 'Commune agricole', 'population' => 85000, 'superficie' => 2289, 'localisation' => 'Nord-Est'],
            ['nom_region' => 'Tchaourou', 'description' => 'Commune natale de l\'ancien président Boni Yayi', 'population' => 220000, 'superficie' => 7256, 'localisation' => 'Nord-Est'],

            // Département de l'Alibori
            ['nom_region' => 'Banikoara', 'description' => 'Première région cotonnière du Bénin', 'population' => 210000, 'superficie' => 4383, 'localisation' => 'Nord'],
            ['nom_region' => 'Gogounou', 'description' => 'Commune agricole et d\'élevage', 'population' => 140000, 'superficie' => 4784, 'localisation' => 'Nord'],
            ['nom_region' => 'Kandi', 'description' => 'Chef-lieu de l\'Alibori, ville commerciale', 'population' => 190000, 'superficie' => 3421, 'localisation' => 'Nord'],
            ['nom_region' => 'Karimama', 'description' => 'Commune frontalière avec le Niger', 'population' => 80000, 'superficie' => 6152, 'localisation' => 'Nord'],
            ['nom_region' => 'Malanville', 'description' => 'Port fluvial sur le Niger, frontière avec le Niger', 'population' => 180000, 'superficie' => 3026, 'localisation' => 'Nord'],
            ['nom_region' => 'Ségbana', 'description' => 'Commune agricole et minière', 'population' => 95000, 'superficie' => 4727, 'localisation' => 'Nord'],

            // Département de l'Atacora
            ['nom_region' => 'Boukoumbé', 'description' => 'Région des tatas somba, architecture unique', 'population' => 120000, 'superficie' => 1036, 'localisation' => 'Nord-Ouest'],
            ['nom_region' => 'Cobly', 'description' => 'Commune frontalière avec le Togo', 'population' => 90000, 'superficie' => 825, 'localisation' => 'Nord-Ouest'],
            ['nom_region' => 'Kérou', 'description' => 'Porte d\'entrée du parc national de la Pendjari', 'population' => 130000, 'superficie' => 3150, 'localisation' => 'Nord-Ouest'],
            ['nom_region' => 'Kouandé', 'description' => 'Région montagneuse aux paysages spectaculaires', 'population' => 160000, 'superficie' => 1800, 'localisation' => 'Nord-Ouest'],
            ['nom_region' => 'Matéri', 'description' => 'Commune agricole et touristique', 'population' => 140000, 'superficie' => 4200, 'localisation' => 'Nord-Ouest'],
            ['nom_region' => 'Natitingou', 'description' => 'Chef-lieu de l\'Atacora, ville touristique', 'population' => 180000, 'superficie' => 3045, 'localisation' => 'Nord-Ouest'],
            ['nom_region' => 'Pehonko', 'description' => 'Commune rurale aux traditions ancestrales', 'population' => 70000, 'superficie' => 950, 'localisation' => 'Nord-Ouest'],
            ['nom_region' => 'Tanguiéta', 'description' => 'Ville proche du parc de la Pendjari', 'population' => 130000, 'superficie' => 3360, 'localisation' => 'Nord-Ouest'],
            ['nom_region' => 'Toucountouna', 'description' => 'Commune agricole', 'population' => 75000, 'superficie' => 1600, 'localisation' => 'Nord-Ouest'],

            // Département de la Donga
            ['nom_region' => 'Bassila', 'description' => 'Commune frontalière avec le Togo', 'population' => 150000, 'superficie' => 1200, 'localisation' => 'Centre-Nord'],
            ['nom_region' => 'Copargo', 'description' => 'Commune agricole', 'population' => 110000, 'superficie' => 876, 'localisation' => 'Centre-Nord'],
            ['nom_region' => 'Djougou', 'description' => 'Plus grande ville de la Donga, carrefour commercial', 'population' => 320000, 'superficie' => 3940, 'localisation' => 'Centre-Nord'],
            ['nom_region' => 'Ouaké', 'description' => 'Commune aux paysages de collines', 'population' => 100000, 'superficie' => 1250, 'localisation' => 'Centre-Nord'],

            // Département des Collines
            ['nom_region' => 'Bantè', 'description' => 'Commune agricole réputée pour son beurre de karité', 'population' => 140000, 'superficie' => 2671, 'localisation' => 'Centre'],
            ['nom_region' => 'Dassa-Zoumè', 'description' => 'Ville aux 41 collines, lieu de pèlerinage', 'population' => 200000, 'superficie' => 1111, 'localisation' => 'Centre'],
            ['nom_region' => 'Glazoué', 'description' => 'Commune agricole et minière', 'population' => 170000, 'superficie' => 1300, 'localisation' => 'Centre'],
            ['nom_region' => 'Ouèssè', 'description' => 'Région de production d\'anacarde', 'population' => 160000, 'superficie' => 2000, 'localisation' => 'Centre'],
            ['nom_region' => 'Savalou', 'description' => 'Royaume historique des Sahouè', 'population' => 220000, 'superficie' => 2600, 'localisation' => 'Centre'],
            ['nom_region' => 'Savè', 'description' => 'Commune aux traditions culturelles riches', 'population' => 190000, 'superficie' => 2100, 'localisation' => 'Centre'],

            // Département du Couffo
            ['nom_region' => 'Aplahoué', 'description' => 'Chef-lieu du Couffo', 'population' => 160000, 'superficie' => 730, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Djakotomey', 'description' => 'Commune agricole', 'population' => 130000, 'superficie' => 432, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Dogbo', 'description' => 'Commune en développement rapide', 'population' => 190000, 'superficie' => 475, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Klouékanmè', 'description' => 'Commune aux traditions vodoun', 'population' => 120000, 'superficie' => 600, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Lalo', 'description' => 'Commune agricole', 'population' => 140000, 'superficie' => 512, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Toviklin', 'description' => 'Petite commune rurale', 'population' => 90000, 'superficie' => 350, 'localisation' => 'Sud-Ouest'],

            // Département de l'Ouémé
            ['nom_region' => 'Adjarra', 'description' => 'Commune historique du plateau', 'population' => 150000, 'superficie' => 184, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Adjohoun', 'description' => 'Commune riveraine de l\'Ouémé', 'population' => 120000, 'superficie' => 112, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Aguégués', 'description' => 'Commune lacustre', 'population' => 60000, 'superficie' => 70, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Akpro-Missérété', 'description' => 'Commune périurbaine', 'population' => 180000, 'superficie' => 79, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Avrankou', 'description' => 'Région de production de riz', 'population' => 150000, 'superficie' => 150, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Bonou', 'description' => 'Commune riveraine', 'population' => 70000, 'superficie' => 100, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Dangbo', 'description' => 'Commune agricole', 'population' => 160000, 'superficie' => 275, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Porto-Novo', 'description' => 'Capitale administrative du Bénin', 'population' => 265000, 'superficie' => 110, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Sèmè-Kpodji', 'description' => 'Commune industrielle et portuaire', 'population' => 230000, 'superficie' => 250, 'localisation' => 'Sud-Est'],

            // Département du Plateau
            ['nom_region' => 'Ifangni', 'description' => 'Commune frontalière avec le Nigeria', 'population' => 140000, 'superficie' => 600, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Adja-Ouèrè', 'description' => 'Commune agricole', 'population' => 130000, 'superficie' => 500, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Kétou', 'description' => 'Ancien royaume Yoruba', 'population' => 210000, 'superficie' => 2400, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Pobè', 'description' => 'Capitale de l\'ananas au Bénin', 'population' => 190000, 'superficie' => 400, 'localisation' => 'Sud-Est'],
            ['nom_region' => 'Sakété', 'description' => 'Commune agricole', 'population' => 170000, 'superficie' => 600, 'localisation' => 'Sud-Est'],

            // Département du Mono
            ['nom_region' => 'Athieme', 'description' => 'Commune riveraine du Mono', 'population' => 70000, 'superficie' => 178, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Bopa', 'description' => 'Commune lacustre', 'population' => 110000, 'superficie' => 365, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Comè', 'description' => 'Commune littorale', 'population' => 130000, 'superficie' => 217, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Grand-Popo', 'description' => 'Station balnéaire historique', 'population' => 85000, 'superficie' => 289, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Houéyogbé', 'description' => 'Commune agricole', 'population' => 140000, 'superficie' => 503, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Lokossa', 'description' => 'Chef-lieu du Mono', 'population' => 210000, 'superficie' => 260, 'localisation' => 'Sud-Ouest'],
            ['nom_region' => 'Sè', 'description' => 'Commune rurale', 'population' => 90000, 'superficie' => 300, 'localisation' => 'Sud-Ouest'],

            // Département de la Zou
            ['nom_region' => 'Abomey', 'description' => 'Ancienne capitale du royaume du Dahomey', 'population' => 180000, 'superficie' => 142, 'localisation' => 'Centre-Sud'],
            ['nom_region' => 'Agbangnizoun', 'description' => 'Commune historique', 'population' => 110000, 'superficie' => 244, 'localisation' => 'Centre-Sud'],
            ['nom_region' => 'Bohicon', 'description' => 'Ville carrefour, centre économique', 'population' => 220000, 'superficie' => 160, 'localisation' => 'Centre-Sud'],
            ['nom_region' => 'Covè', 'description' => 'Commune agricole', 'population' => 130000, 'superficie' => 525, 'localisation' => 'Centre-Sud'],
            ['nom_region' => 'Djidja', 'description' => 'Plus grande commune du Bénin en superficie', 'population' => 240000, 'superficie' => 3660, 'localisation' => 'Centre-Sud'],
            ['nom_region' => 'Ouinhi', 'description' => 'Commune agricole', 'population' => 100000, 'superficie' => 281, 'localisation' => 'Centre-Sud'],
            ['nom_region' => 'Za-Kpota', 'description' => 'Commune rurale', 'population' => 120000, 'superficie' => 378, 'localisation' => 'Centre-Sud'],
            ['nom_region' => 'Zangnanado', 'description' => 'Commune aux carrières de pierre', 'population' => 130000, 'superficie' => 510, 'localisation' => 'Centre-Sud'],
            ['nom_region' => 'Zogbodomey', 'description' => 'Commune agricole', 'population' => 150000, 'superficie' => 600, 'localisation' => 'Centre-Sud'],
        ];

        foreach ($communes as $commune) {
            Region::create($commune);
        }
    }
}
