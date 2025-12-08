<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    /**
     * Les champs que l'on peut remplir via create()
     */
    protected $fillable = [
        'user_id',
        'contenu_id',
        'reference_fedapay', // L'ID de transaction unique renvoyé par FedaPay
        'amount',            // Montant en XOF
        'status',            // pending, approved, declined, cancelled
    ];

    /**
     * Constantes pour éviter les "magic strings" dans le code
     * Utilisation : Payment::STATUS_APPROVED
     */
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_DECLINED = 'declined';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * Relation : Un paiement appartient à un utilisateur.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation : Un paiement concerne un contenu spécifique.
     */
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'contenu_id');
    }

    /**
     * Helper : Vérifie si le paiement est validé.
     * Utilisation dans la vue : $payment->isApproved()
     */
    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED;
    }
}