<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
 use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = "users";
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'user_id',
        'profile_image',
        'email_verified_at',
        'password',
        'password_user',
        'address',
        'city_id',
        'vertices',
        'area', 
        'zone_id',
        'user_status',
        'user_type',
        'user_otp',
        'user_otp_verified',
        'duty_status',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ProfileImage()
    {
        
      
        if ($this->profile_image) {
          
            return url(env('APP_ADMIN_IMAGES').'/'.$this->profile_image);
        } else {
            return url('admin/img/default_image.png');
        }
    }

    
    public function storedetails(){
        return $this->belongsTo('App\Models\Seller','id','sd_usid')->where('sd_status','1');
    }
    public function city(){
        return $this->belongsTo('App\Models\City','city_id','city_id')->where('city_status','1');
    }

    public function permissions() {
        return $this->belongsToMany('App\Models\Permission');
    }



    public static function allseller()
    {
        return  User::where('user_type','=',2)->where('user_status','=',1)->pluck('first_name','id')->all();      
    }




}
