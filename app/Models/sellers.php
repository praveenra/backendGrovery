<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Seller;

class sellers extends Authenticatable
{
    use Notifiable;
    protected $guard = 'seller';
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
	
	
public static function allseller()
{
    return  seller::where('sd_status','=',1)->pluck('sd_sname','sd_usid')->all();      
}
}
