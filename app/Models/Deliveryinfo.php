<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryinfo extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'delivery_info';
    protected $primaryKey = 'id';

    protected $fillable = [
        'city_name',
        'vehicle_name',
        'buisness',
        'use_distance_calculation',
        'profit_mode',
        'profit_value',
        'base_price_distance',
        'base_price',
        'price_per_unit_distance',
        'price_per_unit_time',
        'service_tax',
        'min_fare',
        'select_zone1',
        'select_zone2',
        'amount',
        'created_by',
        'updated_by',       
    ];

    protected $guarded = [];

    public static function allcities()
    {
        return  City::pluck('city_name','city_id')->all();      
    }

}