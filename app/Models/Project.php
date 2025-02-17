<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    use HasFactory;

    protected $fillable = ['name', 'zone_id', 'chef_id'];

    public function zone() {
        return $this->belongsTo(Zone::class);
    }

    public function chef() {
        return $this->belongsTo(User::class, 'chef_id');
    }

    public function employees() {
        return $this->hasMany(User::class, 'project_id');
    }
}
