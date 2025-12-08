<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeMedia extends Model
{
    protected $table = 'type_medias'; 
    
    protected $fillable = ['nom'];

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class, 'id_type_media');
    }
}