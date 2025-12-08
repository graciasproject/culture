<?php

namespace Database\Seeders;

use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\Region;
use App\Models\Langue;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ContenuSeeder extends Seeder
{
    public function run()
    {
        // Récupérer les données existantes avec vérification
        $typesContenu = TypeContenu::all();
        $regions = Region::all();
        $langues = Langue::all();
        $users = User::all();

        // Vérifier que les données nécessaires existent
        if ($typesContenu->isEmpty() || $regions->isEmpty() || $langues->isEmpty() || $users->isEmpty()) {
            $this->command->error('Données manquantes pour le seeding des contenus!');
            return;
        }

        // Récupérer l'ID du premier utilisateur (pour l'auteur)
        $id_auteur = $users->first()->id;

        $contenus = [
            // --- Contenu initial (pour l'exemple) ---
            [
                'titre' => 'La Légende du Roi Béhanzin',
                'texte' => 'Dernier roi du Dahomey, Béhanzin résista farouchement à la colonisation française. Son courage et sa détermination en firent un symbole de la résistance africaine.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Abomey'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(50),
            ],

            // --- 49 Nouveaux Contenus pour le Bénin Entier ---

            // ** 1. Histoire et Légende **
            [
                'titre' => 'Les Amazones du Dahomey',
                'texte' => 'Corps militaire féminin unique, les Amazones étaient les gardiennes d\'élite du Royaume du Dahomey, réputées pour leur bravoure au combat.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Abomey'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(45),
            ],
            [
                'titre' => 'Le Fort Portugais de Ouidah',
                'texte' => 'Témoignage sombre de la traite négrière, ce fort est un lieu de mémoire essentiel sur l\'histoire du commerce transatlantique.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Ouidah'),
                'id_langue' => $this->getLangueId($langues, 'goun'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(40),
            ],
            [
                'titre' => 'La Fondation de Porto-Novo',
                'texte' => 'Ancienne capitale du Royaume d\'Adjatché, son histoire est intimement liée aux migrations yoruba et à l\'influence portugaise.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Porto-Novo'),
                'id_langue' => $this->getLangueId($langues, 'goun'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(35),
            ],
            [
                'titre' => 'Les Tata Somba de l\'Atacora',
                'texte' => 'Ces châteaux forts en terre crue, typiques du Nord-Bénin, sont le symbole de l\'architecture et de l\'organisation défensive du peuple Batammariba.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Natitingou'),
                'id_langue' => $this->getLangueId($langues, 'ditammari'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(30),
            ],
            [
                'titre' => 'La Porte du Non-Retour',
                'texte' => 'Monument érigé sur la plage de Ouidah, marquant le point final du voyage des esclaves vers les Amériques. Un lieu de recueillement.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Ouidah'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(25),
            ],
            [
                'titre' => 'Le Mythe du Serpent Dangbé de Ouidah',
                'texte' => 'Le Python royal est vénéré à Ouidah. On dit que c\'est l\'esprit protecteur de la ville et qu\'il ne faut jamais lui faire de mal.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Ouidah'),
                'id_langue' => $this->getLangueId($langues, 'goun'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(20),
            ],
            [
                'titre' => 'Le Lac Nokoué et les Pêcheurs Toffinou',
                'texte' => 'L\'histoire de Ganvié, la Venise de l\'Afrique, fondée par les Tofinnou fuyant les razzias esclavagistes en s\'installant sur l\'eau.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Cotonou'),
                'id_langue' => $this->getLangueId($langues, 'toffinou'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(15),
            ],
            [
                'titre' => 'Le Roi Tofa et la Cession de Cotonou',
                'texte' => 'L\'accord complexe qui mena à la cession d\'une partie de Cotonou aux Français, marquant un tournant dans l\'histoire coloniale.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Cotonou'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(10),
            ],
            [
                'titre' => 'L\'Ancienne Route des Esclaves',
                'texte' => 'Le chemin de Ouidah au Fort, parcouru par des milliers d\'esclaves, jalonné de lieux de mémoire et de rituels.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Ouidah'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(5),
            ],
            [
                'titre' => 'La Résistance du Peuple Bariba',
                'texte' => 'L\'histoire des guerriers Bariba du Nord, et de leurs chefs qui luttèrent contre l\'expansion coloniale française.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Parakou'),
                'id_langue' => $this->getLangueId($langues, 'bariba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(1),
            ],
            [
                'titre' => 'Le Traité de Protectorat de Sèmèrè',
                'texte' => 'Un accord marquant la soumission progressive des chefferies du Nord à la puissance coloniale.',
                'statut' => 'brouillon',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Djougou'),
                'id_langue' => $this->getLangueId($langues, 'dendi'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(60),
            ],
            [
                'titre' => 'Le Mythe de la Création Fon',
                'texte' => 'Comment Mahou (le grand créateur) et la divinité Lisa-Mawu ont donné naissance à l\'univers et aux hommes selon la tradition Fon.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Abomey'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(65),
            ],
            [
                'titre' => 'Les Rois de Nikki',
                'texte' => 'L\'histoire du royaume de Nikki, centre du peuple Bariba, et de ses dynasties guerrières qui dominaient le Borgou.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Nikki'),
                'id_langue' => $this->getLangueId($langues, 'bariba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(70),
            ],
            [
                'titre' => 'La Chefferie de Kandi',
                'texte' => 'Centre historique et commercial du Nord-Est, Kandi a joué un rôle clé dans les échanges transsahariens.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Kandi'),
                'id_langue' => $this->getLangueId($langues, 'dendi'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(75),
            ],

            // ** 2. Cuisine Locale et Gastronomie **
            [
                'titre' => 'Le Pâte de Maïs (Aba)',
                'texte' => 'Plat de base consommé dans tout le Sud, souvent accompagné de sauce tomate ou de légumes. La base de l\'alimentation locale.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Cotonou'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(42),
            ],
            [
                'titre' => 'Le Akassa et sa préparation',
                'texte' => 'Pâte fermentée de maïs, typique des régions côtières, servie généralement avec une sauce de poisson.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Porto-Novo'),
                'id_langue' => $this->getLangueId($langues, 'goun'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(37),
            ],
            [
                'titre' => 'L\'igname Pilée (Foufou)',
                'texte' => 'Plat emblématique du centre et du Nord-Bénin, l\'igname pilée est un aliment de fête et de force, servi avec la sauce arachide.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Djougou'),
                'id_langue' => $this->getLangueId($langues, 'yoruba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(32),
            ],
            [
                'titre' => 'Le Wagashi (Fromage Peulh)',
                'texte' => 'Fromage de lait caillé produit par les Peulhs, consommé frit et souvent accompagné d\'une sauce piquante ou de piment.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Parakou'),
                'id_langue' => $this->getLangueId($langues, 'peulh'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(27),
            ],
            [
                'titre' => 'Le Gari (Semoule de Manioc)',
                'texte' => 'Aliment polyvalent, le gari est consommé sous forme de pâte chaude ou de boisson rafraîchissante. Un incontournable.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Abomey-Calavi'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(22),
            ],
            [
                'titre' => 'Tchachanga, la brochette béninoise',
                'texte' => 'Brochettes de viande de bœuf grillée et très épicée, spécialité des nuits de Cotonou.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Cotonou'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(17),
            ],
            [
                'titre' => 'Le Piment à l\'Huile (Adjemé)',
                'texte' => 'Un condiment essentiel qui relève tous les plats au Bénin. Sa préparation varie selon les régions, mais il est toujours très fort!',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Ouidah'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(12),
            ],

            // ** 3. Art et Culture **
            [
                'titre' => 'Les Rituels du Vaudou',
                'texte' => 'Le Vaudou (Vodun) est une religion ancestrale et officielle au Bénin. Elle implique la vénération des esprits et des divinités.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Ouidah'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(48),
            ],
            [
                'titre' => 'Le Cult des Jumeaux (Hohovi)',
                'texte' => 'Chez les Fon et Yoruba, les jumeaux sont considérés comme des êtres sacrés. Leur culte et leurs rites spécifiques sont très importants.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Abomey'),
                'id_langue' => $this->getLangueId($langues, 'yoruba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(43),
            ],
            [
                'titre' => 'Les Masques Guèlèdè',
                'texte' => 'Spectacle de masques Yoruba dédié aux pouvoirs féminins et aux Mères. Un chef-d\'œuvre du patrimoine oral de l\'UNESCO.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Kétou'),
                'id_langue' => $this->getLangueId($langues, 'yoruba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(38),
            ],
            [
                'titre' => 'La Danse Téké de l\'Atacora',
                'texte' => 'Danse traditionnelle des peuples du Nord, exécutée lors des rites de passage et des funérailles.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Natitingou'),
                'id_langue' => $this->getLangueId($langues, 'ditammari'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(33),
            ],
            [
                'titre' => 'Les Fétiches d\'Abomey',
                'texte' => 'Les palais royaux d\'Abomey regorgent de fétiches et de bas-reliefs racontant l\'histoire des rois du Dahomey.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Abomey'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(28),
            ],
            [
                'titre' => 'Le Zangbeto (Gardien de Nuit)',
                'texte' => 'Masque traditionnel du Vaudou, symbolisant le gardien de la nuit. Il est une force de police traditionnelle chez les Goun et Tofinnou.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Porto-Novo'),
                'id_langue' => $this->getLangueId($langues, 'goun'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(23),
            ],
            [
                'titre' => 'Les Griots Bariba (Chasseurs de Gloire)',
                'texte' => 'Les griots Bariba sont les conteurs, musiciens et historiens qui perpétuent la mémoire du peuple à travers les chants et les épopées.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Parakou'),
                'id_langue' => $this->getLangueId($langues, 'bariba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(18),
            ],
            [
                'titre' => 'Le Culte de Sakpata (Dieu de la Terre)',
                'texte' => 'Sakpata est une divinité redoutée, associée à la variole et à la Terre. Ses fidèles sont très respectés.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Abomey-Calavi'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(13),
            ],
            [
                'titre' => 'Le Bassin du Niger et les Peuples Dendi',
                'texte' => 'La culture Dendi est fortement influencée par les traditions du fleuve Niger et les échanges avec les peuples sahéliens.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Malanville'),
                'id_langue' => $this->getLangueId($langues, 'dendi'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(8),
            ],

            // ** 4. Événements et Fêtes **
            [
                'titre' => 'La Fête Nationale du Vaudou',
                'texte' => 'Chaque 10 janvier, les adeptes de tout le pays se rassemblent à Ouidah pour célébrer les divinités Vaudou.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Fêtes et Événements'),
                'id_region' => $this->getRegionId($regions, 'Ouidah'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(55),
            ],
            [
                'titre' => 'Le Festival International du Film de Ouidah',
                'texte' => 'Événement culturel majeur visant à promouvoir le cinéma africain et le dialogue autour de la mémoire de l\'esclavage.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Fêtes et Événements'),
                'id_region' => $this->getRegionId($regions, 'Ouidah'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(52),
            ],
            [
                'titre' => 'La Gaani (Fête des Rois)',
                'texte' => 'Fête traditionnelle des Bariba célébrée à Nikki, marquant le renouvellement de l\'autorité royale et la cohésion sociale.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Fêtes et Événements'),
                'id_region' => $this->getRegionId($regions, 'Nikki'),
                'id_langue' => $this->getLangueId($langues, 'bariba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(47),
            ],
            [
                'titre' => 'La Fête de l\'Igname (Nouvel An Agricole)',
                'texte' => 'Célébrée par de nombreux peuples, notamment les Tcha, elle marque la récolte et le partage de la nouvelle igname.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Fêtes et Événements'),
                'id_region' => $this->getRegionId($regions, 'Djougou'),
                'id_langue' => $this->getLangueId($langues, 'yoruba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(41),
            ],
            [
                'titre' => 'Le Festival des Arts et Cultures Endogènes',
                'texte' => 'Événement visant à valoriser les traditions, les danses et les musiques des peuples du Bénin.',
                'statut' => 'brouillon',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Fêtes et Événements'),
                'id_region' => $this->getRegionId($regions, 'Cotonou'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(36),
            ],
            [
                'titre' => 'Les Cérémonies des Funérailles Bétammaribé',
                'texte' => 'Funérailles complexes et rituelles chez les Bétammaribé, ponctuées de danses et de symboles forts.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Fêtes et Événements'),
                'id_region' => $this->getRegionId($regions, 'Natitingou'),
                'id_langue' => $this->getLangueId($langues, 'ditammari'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(31),
            ],
            [
                'titre' => 'La Fête des Egungun',
                'texte' => 'Célébration des esprits des ancêtres, où des individus masqués sortent pour bénir ou réprimander la communauté.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Fêtes et Événements'),
                'id_region' => $this->getRegionId($regions, 'Porto-Novo'),
                'id_langue' => $this->getLangueId($langues, 'yoruba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(26),
            ],

            // ** 5. Autres Contenus Culturels/Historiques (complément) **
            [
                'titre' => 'La Place des Martyrs à Cotonou',
                'texte' => 'Lieu de mémoire rendant hommage aux victimes des événements politiques majeurs de l\'histoire du Bénin.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Cotonou'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(21),
            ],
            [
                'titre' => 'Les Textiles Traditionnels Kente du Sud',
                'texte' => 'Le tissage du Kente, bien que plus célèbre au Ghana, a des racines et des motifs spécifiques dans le Sud-Est du Bénin.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Porto-Novo'),
                'id_langue' => $this->getLangueId($langues, 'goun'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(16),
            ],
            [
                'titre' => 'L\'Architecture Afro-Brésilienne de Ouidah',
                'texte' => 'Les maisons coloniales colorées témoignent du retour des esclaves affranchis du Brésil, qui ont influencé l\'urbanisme.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Ouidah'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(11),
            ],
            [
                'titre' => 'Le Marché Dantokpa, Cœur Économique',
                'texte' => 'L\'un des plus grands marchés d\'Afrique de l\'Ouest, Dantokpa est un lieu culturel vibrant et un carrefour commercial essentiel.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Cotonou'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(6),
            ],
            [
                'titre' => 'Les Parcs Nationaux : Pendjari et W',
                'texte' => 'Patrimoine naturel du Nord, ces parcs sont essentiels à la conservation de la faune africaine et à l\'écotourisme.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'), // Type plus général
                'id_region' => $this->getRegionId($regions, 'Tanguiéta'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(2),
            ],
            // Ajout de 20 contenus supplémentaires pour atteindre 50 au total (1 initial + 49 nouveaux)
            [
                'titre' => 'La Sauce Gombo du Nord (Féfé)',
                'texte' => 'Préparation épaisse et gluante à base de gombo frais, très populaire dans le Nord du Bénin et accompagnée d\'igname.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Parakou'),
                'id_langue' => $this->getLangueId($langues, 'bariba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(78),
            ],
            [
                'titre' => 'L\'Arbre aux Cauris de Porto-Novo',
                'texte' => 'Légende locale racontant l\'origine de la richesse et de l\'importance du cauri comme monnaie dans l\'ancien royaume.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Porto-Novo'),
                'id_langue' => $this->getLangueId($langues, 'goun'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(80),
            ],
            [
                'titre' => 'Le Palais Royal de Kétou',
                'texte' => 'Résidence de l\'Alakétou (roi de Kétou), ce palais est un centre de la culture Yoruba au Bénin.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Kétou'),
                'id_langue' => $this->getLangueId($langues, 'yoruba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(82),
            ],
            [
                'titre' => 'La Cérémonie de Prise de Possession du Trône à Abomey',
                'texte' => 'Rituel complexe et secret qui accompagne l\'intronisation d\'un nouveau roi du Dahomey.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Fêtes et Événements'),
                'id_region' => $this->getRegionId($regions, 'Abomey'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(84),
            ],
            [
                'titre' => 'Le Djenkafo (Riz à la sauce d\'arachide)',
                'texte' => 'Plat courant et apprécié, mélange de riz avec une sauce riche en pâte d\'arachide, typique de l\'intérieur du pays.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Djougou'),
                'id_langue' => $this->getLangueId($langues, 'dendi'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(86),
            ],
            [
                'titre' => 'Les Potières de Savalou',
                'texte' => 'L\'artisanat de la poterie est une tradition féminine forte dans la région de Savalou, avec des techniques ancestrales.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Savalou'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(88),
            ],
            [
                'titre' => 'Le Mythe des Chutes de Kota',
                'texte' => 'Légende associée aux magnifiques chutes de la région, souvent considérées comme sacrées.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Natitingou'),
                'id_langue' => $this->getLangueId($langues, 'ditammari'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(90),
            ],
            [
                'titre' => 'Les Tapis en Pagne de Allada',
                'texte' => 'L\'art du tissage et de la teinture du pagne est une spécialité de cette ancienne ville royale.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Allada'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(92),
            ],
            [
                'titre' => 'L\'Oli (Bière de Mil)',
                'texte' => 'Boisson traditionnelle, fermentée à base de mil ou de sorgho, très populaire dans le Nord du pays lors des fêtes.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Parakou'),
                'id_langue' => $this->getLangueId($langues, 'bariba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(94),
            ],
            [
                'titre' => 'Le Mythe de la fondation de Cové',
                'texte' => 'Légende locale expliquant l\'établissement de cette ville stratégique et sa relation avec le fleuve Ouémé.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Cové'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(96),
            ],
            [
                'titre' => 'La Statue de Bio Guéra à Parakou',
                'texte' => 'Hommage au héros de la résistance Bariba contre la colonisation française, symbole de fierté nationale.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Parakou'),
                'id_langue' => $this->getLangueId($langues, 'bariba'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(98),
            ],
            [
                'titre' => 'La Danse Vodun Hungan',
                'texte' => 'Danse extatique des prêtres Hungan, lors des cérémonies dédiées aux divinités de l\'eau ou de la forêt.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Ouidah'),
                'id_langue' => $this->getLangueId($langues, 'goun'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(100),
            ],
            [
                'titre' => 'Le Mythe de la création Adja',
                'texte' => 'Récit de l\'origine du peuple Adja et de ses migrations vers le Bénin et le Togo.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Allada'),
                'id_langue' => $this->getLangueId($langues, 'aja'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(102),
            ],
            [
                'titre' => 'Le Riz Sauce Feuille de Kandi',
                'texte' => 'Plat local où le riz est servi avec une sauce épaisse à base de feuilles (épinards, amarante, etc.) et de viande séchée.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Kandi'),
                'id_langue' => $this->getLangueId($langues, 'dendi'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(104),
            ],
            [
                'titre' => 'Le Festival de la Culture et de la Gastronomie Peulh',
                'texte' => 'Événement célébrant le mode de vie nomade, la musique et les plats à base de lait du peuple Peulh.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Fêtes et Événements'),
                'id_region' => $this->getRegionId($regions, 'Malanville'),
                'id_langue' => $this->getLangueId($langues, 'peulh'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(106),
            ],
            [
                'titre' => 'Les Instruments de Musique Traditionnels',
                'texte' => 'Présentation des tambours (Tchamba, Gan Gan), des cors et des hochets utilisés dans les cérémonies et fêtes béninoises.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Abomey-Calavi'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(108),
            ],
            [
                'titre' => 'L\'Histoire du Chemin de Fer Cotonou-Parakou',
                'texte' => 'Le rôle stratégique de la construction de la ligne de chemin de fer dans le développement économique et colonial du Dahomey.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Parakou'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(110),
            ],
            [
                'titre' => 'Le Mythe de la Colline Sacrée de Dassa',
                'texte' => 'Récit sur l\'importance spirituelle et l\'origine des falaises et des grottes de Dassa, lieu de pèlerinage.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Dassa-Zoumé'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(112),
            ],
            [
                'titre' => 'La Préparation de l\'Akpan (Boisson de Maïs)',
                'texte' => 'Boisson rafraîchissante et nourrissante à base de maïs fermenté, consommée partout au Bénin.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Cuisine Locale'),
                'id_region' => $this->getRegionId($regions, 'Cotonou'),
                'id_langue' => $this->getLangueId($langues, 'francais'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(114),
            ],
            [
                'titre' => 'Le Marché des Fétiches de Cotonou',
                'texte' => 'Aussi appelé Marché Akodessawa, c\'est un lieu unique où l\'on trouve herbes médicinales et objets rituels vaudou.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Cotonou'),
                'id_langue' => $this->getLangueId($langues, 'fon'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(116),
            ],
            [
                'titre' => 'La Danse du Sâgbo de l\'Ouémé',
                'texte' => 'Danse traditionnelle associée à la pêche et au fleuve Ouémé, souvent exécutée pour garantir de bonnes prises.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Art et Culture'),
                'id_region' => $this->getRegionId($regions, 'Porto-Novo'),
                'id_langue' => $this->getLangueId($langues, 'goun'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(118),
            ],
            [
                'titre' => 'L\'Histoire des Migrations du Peuple Adja-Tado',
                'texte' => 'Le récit des rois fondateurs qui sont partis de Tado pour créer les royaumes d\'Allada, Abomey et Porto-Novo.',
                'statut' => 'publié',
                'id_type_contenu' => $this->getTypeId($typesContenu, 'Histoire et Légende'),
                'id_region' => $this->getRegionId($regions, 'Allada'),
                'id_langue' => $this->getLangueId($langues, 'aja'),
                'id_auteur' => $id_auteur,
                'date_creation' => Carbon::now()->subDays(120),
            ],


        ];

        foreach ($contenus as $contenu) {
            // Vérifier que toutes les clés étrangères existent
            if ($contenu['id_type_contenu'] && $contenu['id_region'] && $contenu['id_langue'] && $contenu['id_auteur']) {
                Contenu::create($contenu);
            } else {
                $this->command->warn('Contenu ignoré - données manquantes: ' . $contenu['titre']);
            }
        }

        $this->command->info(count($contenus) . ' contenus ont été insérés (ou tentés) dans la base de données.');
    }

    // Méthodes helpers pour gérer les données manquantes
    private function getTypeId($types, $nom)
    {
        $type = $types->where('nom', $nom)->first();
        return $type ? $type->id : null;
    }

    private function getRegionId($regions, $nom)
    {
        // Supposons que le nom de la colonne est bien 'nom_region'
        $region = $regions->where('nom_region', $nom)->first();
        return $region ? $region->id : null;
    }

    private function getLangueId($langues, $code)
    {
        // Supposons que le code de la colonne est 'code_langue'
        $langue = $langues->where('code_langue', $code)->first();
        return $langue ? $langue->id : null;
    }
}
