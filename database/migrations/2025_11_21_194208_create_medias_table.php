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
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_type_media');
            $table->unsignedBigInteger('id_contenu');
            $table->string('chemin');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('id_type_media')->references('id')->on('type_medias');
            $table->foreign('id_contenu')->references('id')->on('contenus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
