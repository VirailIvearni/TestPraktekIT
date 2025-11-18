<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
    'name',
    'posisi',
    'email',
    'password',
    'foto',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];
}
