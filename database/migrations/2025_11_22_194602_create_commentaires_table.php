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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_contenu');
            $table->text('texte');
            $table->integer('note')->nullable();
            $table->dateTime('date_commentaire');
            $table->unsignedBigInteger('id_utilisateur');
            $table->timestamps();
            $table->foreign('id_utilisateur')->references('id')->on('users');
            $table->foreign('id_contenu')->references('id')->on('contenus');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
