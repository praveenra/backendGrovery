<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Superadmin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'superadmin';
    protected $table = "users";
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'profile_image',
        'email_verified_at',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
