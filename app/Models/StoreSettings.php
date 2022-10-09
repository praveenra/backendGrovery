<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class StoreSettings extends Model
{
    public $timestamps = false;
    protected $table = 'store_settings';
    protected $primaryKey = 'id';

    protected $fillable = [
        'seller_id',
        'sunday_check',
        'sunday_opening_time',
        'sunday_closing_time',
        'monday_check',
        'monday_opening_time',
        'monday_closing_time',
        'tuesday_check',
        'tuesday_opening_time',
        'tuesday_closing_time',
        'wednesday_check',
        'wednesday_opening_time',
        'wednesday_closing_time',
        'thursday_check',
        'thursday_opening_time',
        'thursday_closing_time',
        'friday_check',
        'friday_opening_time',
        'friday_closing_time',
        'saturday_check',
        'saturday_opening_time',
        'saturday_closing_time',
        'business',    
    ];

    protected $guarded = [];


}