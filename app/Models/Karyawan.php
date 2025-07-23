<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Ganti dari Model ke ini
use Illuminate\Notifications\Notifiable;

class Karyawan extends Authenticatable
{
    use Notifiable;

    protected $table = 'Karyawan';

    protected $fillable = [
        'nama', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password',
    ];
}
