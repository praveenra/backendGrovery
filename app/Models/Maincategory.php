<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Maincategory extends Model
{
    public $timestamps = false;
    protected $table = 'main_category';
    protected $primaryKey = 'mc_id';

    protected $fillable = [
        'mc_name',
       
        'mc_status',
        'mc_commision',
        'created_by',
        'updated_by',       
        'image',       
    ];

    protected $guarded = [];

    public function category_seller(){
        return $this->belongsTo('App\Models\User','id')->where('user_status','1');
    }


public static function allmaincategory()
{
return  Maincategory::where('mc_status','1')->pluck('mc_name','mc_id')->all();      
}

}