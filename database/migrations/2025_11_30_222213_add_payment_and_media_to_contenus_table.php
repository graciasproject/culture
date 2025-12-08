<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contenus', function (Blueprint $table) {
            // Pour le Paywall
            $table->integer('prix')->default(0)->after('texte'); // Prix en XOF (0 = gratuit)
            $table->boolean('is_premium')->default(false)->after('prix'); // Pour identifier les contenus payants

            // Pour les Médias (Carousel & Vidéo)
            $table->string('image_couverture')->nullable()->after('titre'); // L'image pour la carte du Carousel
            $table->string('video_url')->nullable()->after('image_couverture'); // Le lien de la vidéo (ou chemin local)
            
            // Un champ pour le résumé (Teaser) si on ne veut pas couper le texte brut
            $table->text('resume')->nullable()->after('titre'); 
        });
    }

    public function down(): void
    {
        Schema::table('contenus', function (Blueprint $table) {
            $table->dropColumn(['prix', 'is_premium', 'image_couverture', 'video_url', 'resume']);
        });
    }
};