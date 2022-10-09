<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    public $timestamps = false;
    protected $table = 'city';
    protected $primaryKey = 'city_id';

    protected $fillable = [
        'city_name',
        'city_status',
        'created_by',
        'updated_by',       
    ];

    protected $guarded = [];

    public static function allcities()
    {
        return  City::pluck('city_name','city_id')->all();      
    }


}