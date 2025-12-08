<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contenu extends Model
{
protected $fillable = [
        'titre',
        'texte',
        'date_creation',
        'statut',
        'parent_id',
        'id_auteur',
        'id_region', 
        'id_moderateur',
        'id_langue',
        'id_type_contenu',
        'date_validation'
    ];

    public function auteur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_auteur');
    }
    public function moderateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_moderateur');
    }
    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class, 'id_region');
    }
    public function langue(): BelongsTo
    {
        return $this->belongsTo(Langue::class, 'id_langue');    
    }
    public function typeContenu(): BelongsTo
    {
        return $this->belongsTo(TypeContenu::class, 'id_type_contenu');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Contenu::class, 'parent_id');   
    }

    public function enfants(): HasMany
    {
        return $this->hasMany(Contenu::class, 'parent_id');
    }

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class, 'id_contenu');
    }

    public function commentaires(): HasMany
    {
        return $this->hasMany(Commentaire::class, 'id_contenu');
    }
}