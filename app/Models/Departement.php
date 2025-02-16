<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departements';

    protected $fillable = [
        'nom_dep',
        'id_chef_departement',
    ];

    /**
     * Relation avec l'utilisateur (Chef de Département)
     */
    public function chefDepartement()
    {
        return $this->belongsTo(User::class, 'id_chef_departement');
    }
}
