<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model {
    use HasFactory;

    protected $fillable = [
        'nom', 'latitude', 'longitude', 'coordinates', 'created_by', 'city', 'country', 'chef_id'
    ];

    // Relation avec le chef de zone (User)
    public function chef() {
        return $this->belongsTo(User::class, 'chef_id');
    }

    // Relation avec les projets
    public function projects() {
        return $this->hasMany(Project::class);
    }
}



 