<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class deviceid extends Authenticatable
{
	use HasApiTokens, Notifiable;
    protected $table = "deviceid";
	

}
