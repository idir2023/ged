<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    use HasFactory;

    protected $fillable = ['name', 'description', 'zone_id', 'chef_projet_id'];

    public function chefProjet() {
        return $this->belongsTo(User::class, 'chef_projet_id');
    }

    public function zone() {
        return $this->belongsTo(Zone::class);
    }
 
}
