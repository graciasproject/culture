<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // On lie le paiement à un contenu spécifique
            $table->foreignId('contenu_id')->constrained('contenus')->onDelete('cascade'); 
            $table->string('reference_fedapay')->unique(); // ID de transaction FedaPay
            $table->string('status')->default('pending'); // pending, approved, declined
            $table->integer('amount'); // Montant payé
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};