<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'id_langue',
        'date_naissance',
        'statut',
        'photo',
        'id_role',
        'email',
        'mot_de_passe',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_naissance' => 'date',
            'mot_de_passe' => 'hashed',
        ];
    }

    /**
     * METHODE IMPORTANTE : Dire à Laravel d'utiliser 'mot_de_passe' comme colonne de mot de passe
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    // ... vos relations existantes
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function langue(): BelongsTo
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    public function contenus(): HasMany
    {
        return $this->hasMany(Contenu::class, 'id_auteur');
    }

    public function contenusModeres(): HasMany
    {
        return $this->hasMany(Contenu::class, 'id_moderateur');
    }

    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaire::class, 'id_utilisateur');
    }
}
