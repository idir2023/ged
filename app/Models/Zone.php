<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $table = 'zones';

    protected $fillable = [
        'nom',
        'latitude',
        'longitude',
        'coordinates',
        'id_chef_zone',
        'city',
        'country',
    ];

    /**
     * Relation avec l'utilisateur (Chef de Zone)
     */
    public function chefZone()
    {
        return $this->belongsTo(User::class, 'id_chef_zone');
    }
}
