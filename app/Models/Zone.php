<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    /**
     * Nom de la table associée au modèle.
     */
    protected $table = 'zones';

    /**
     * Les attributs qui peuvent être assignés en masse.
     */
    protected $fillable = [
        'nom',
        'latitude',
        'longitude',
    ];

    /**
     * Formatage des valeurs avant enregistrement.
     */
    public function setLatitudeAttribute($value)
    {
        $this->attributes['latitude'] = number_format($value, 8, '.', '');
    }

    public function setLongitudeAttribute($value)
    {
        $this->attributes['longitude'] = number_format($value, 8, '.', '');
    }
}
