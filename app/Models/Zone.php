<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Zone extends Model
{
    public $timestamps = false;
    protected $table = 'zone';
    protected $primaryKey = 'zone_id';

    protected $fillable = [
        'zone_name',
        'zone_lat',
        'zone_lon',
        'zone_radius',
        'zone_status',
        'created_by',
        'updated_by',       
    ];

    protected $guarded = [];

    public static function allzone()
    {
        return  Zone::pluck('zone_name','zone_id')->all();      
    }




}