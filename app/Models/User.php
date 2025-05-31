<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'is_verified',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Cek apakah user adalah admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Cek apakah user adalah staff.
     */
    public function isStaff()
    {
        return $this->role === 'staff';
    }

    /**
     * Cek apakah user sudah diverifikasi admin.
     */
    public function isVerified()
    {
        return $this->is_verified;
    }
}
