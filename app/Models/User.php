<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cedula',
        'address',
        'phone',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

/*
    public function packages()
    {
        return $this->belongsToMany(Package::class, 'service_requests', 'user_id', 'package_id');
    }
    public function services()
    {
        return $this->belongsToMany(Services::class, 'service_requests', 'user_id', 'service_id');
    }


   */
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }
    
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    
    public function scopeWalkers($query){

        return $query->where('role','walker');
    }

    public function scopeUsers($query){

        return $query->where('role','user');
    }
    public function isAdmin()
    {
    return $this->role === 'admin';
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
    
    public function scheduled()
    {
        return $this->hasMany(Scheduled::class);
    }
}
