<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'departement_id', 'latitude', 'longitude', 'zone_id', 'chef_id', 'created_by'];

    // Relation avec le département
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    // Relation avec la zone
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    // Relation avec le chef de projet
    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

   
}
