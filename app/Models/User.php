<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Softdeletes, Prunable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    // Relazioni

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function photos(){
        return $this->hasMany(UserPhoto::class);
    }

    // Verifica ruoli
    public function isAdmin() {
        return $this->roles()->where('name', 'Administrator')->exists();
    }

    public function isManager() {
        return $this->roles()->where('name', 'Manager')->exists();
    }

    public function isBlogger() {
        return $this->roles()->where('name', 'Blogger')->exists();
    }

    public function isCustomer() {
        return $this->roles()->where('name', 'Customer')->exists();
    }

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subWeek());
    }

}
