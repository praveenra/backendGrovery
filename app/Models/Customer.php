<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class Customer extends Authenticatable
{
    use HasApiTokens,Notifiable;

    public $timestamps = false;
    protected $table = 'customer';
	 protected $guard = 'customer';
    protected $primaryKey = 'id';
    protected $casts = [
      'dob' => 'datetime:d-m-Y',
   ];

    protected $fillable = [
        'email',
        'phone_no',
        'name',
        'password',
    ];

	        protected $hidden = [
            'password', 'remember_token',
        ];



}
