<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    protected $fillable = [
        'email',
        'password',
        'level',
        'aktif',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function karyawan()
    {
        return $this->hasOne(Karyawan::class, 'id_user');
    }
    
    public function pelanggan()
    {
        return $this->hasOne(Pelanggan::class, 'id_user');
    }

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'id_user');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'id_user');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
