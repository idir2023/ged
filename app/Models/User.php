<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia; // Add InteractsWithMedia trait

    protected $fillable = [
        'name', 'email', 'password', 'departement_id', 'zone_id', 'project_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Register Media Collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatars')->singleFile();
    }

    /**
     * Relations
     */
    
    // Relation avec le Département
    public function department()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    // Relation avec la Zone
    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }

    // Relation avec le Projet
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
 
    public function userRoles()
    {
        return $this->roles()->pluck('name')->implode(', '); // Appelle la relation `roles()`
    }
}

  
