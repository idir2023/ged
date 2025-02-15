<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ChefDeDepartement extends Authenticatable
{
    use HasFactory;

    protected $table = 'chef_de_departements';
    protected $primaryKey = 'id_chef';

    protected $fillable = [
        'nom_chef',
        'prenom_chef',
        'email_chef',
        'telephone_chef',
        'mot_de_passe_chef_projet',
        'id_dep',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_dep');
    }


    

    protected $hidden = [
        'mot_de_passe_chef_projet',
    ];

    // ✅ Laravel utilise ce champ pour l'authentification
    public function getAuthPassword()
    {
        return $this->mot_de_passe_chef_projet;
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_dep');
    }
}
