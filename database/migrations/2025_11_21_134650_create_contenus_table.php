<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contenus', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('texte');
            $table->date('date_creation');
            $table->string('statut');
            $table->integer('parent_id')->nullable();
            $table->unsignedBigInteger('id_auteur');
            $table->unsignedBigInteger('id_region');
            $table->unsignedBigInteger('id_moderateur')->nullable();
            $table->unsignedBigInteger('id_langue');    
            $table->unsignedBigInteger('id_type_contenu');
            $table->date('date_validation')->nullable();
            $table->timestamps();

            $table->foreign('id_auteur')->references('id')->on('users');
            $table->foreign('id_type_contenu')->references('id')->on('type_contenus');
            $table->foreign('id_region')->references('id')->on('regions');
            $table->foreign('id_langue')->references('id')->on('langues');
            $table->foreign('id_moderateur')->references('id')->on('users');
           

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
