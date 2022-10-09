<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Area extends Model
{
    public $timestamps = false;
    protected $table = 'area';
    protected $primaryKey = 'area_id';

    protected $fillable = [
        'area_name',
        'area_cityid',
        'Zone_id',
        'area_status',
        'created_by',
        'updated_by',       
    ];

    protected $guarded = [];

    public static function allareas()
    {
        return  Area::pluck('area_name','area_id')->all();      
    }

    public function cities(){
        return $this->belongsTo('App\Models\City','area_cityid','city_id')->where('city_status','1');
    }


}