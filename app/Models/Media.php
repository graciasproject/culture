<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
       protected $table = 'medias';
    protected $fillable = ['chemin', 'description', 'id_type_media', 'id_contenu'];

    public function typeMedia(): BelongsTo
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media');
    }
}
