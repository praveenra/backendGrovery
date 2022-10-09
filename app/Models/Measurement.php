<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Measurement extends Model
{
    public $timestamps = false;
    protected $table = 'measurement';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by',       
    ];

    protected $guarded = [];




public static function allmeasurement()
{
    return  Measurement::where('status','=',1)->pluck('name','id')->all();      
}
}