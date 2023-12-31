<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ADMIN_ROLE_ID = 1;
    const USER_ROLE_ID = 2;
    const DOSEN_ROLE_ID = 3;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'position_id',
        'schools_id',
        'locations_id',
        'phone',
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
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'locations_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'user_id', 'id')->whereNotNull('user_id');
    }

    // public function presences()
    // {
    //     return $this->hasMany(Presence::class);
    // }


    public function scopeOnlyEmployees($query)
    {
        return $query->where('role_id', self::USER_ROLE_ID);
    }

    public function isAdmin()
    {
        return $this->role_id === self::ADMIN_ROLE_ID;
    }

    public function isUser()
    {
        return $this->role_id === self::USER_ROLE_ID;
    }

    public function isDosen()
    {
        return $this->role_id === self::DOSEN_ROLE_ID;
    }
}
