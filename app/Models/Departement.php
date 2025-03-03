<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model {
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'chef_id'];

    public function chef() {
        return $this->belongsTo(User::class, 'chef_id');
    }

    public function employees() {
        return $this->hasMany(User::class, 'department_id');
    }
}
