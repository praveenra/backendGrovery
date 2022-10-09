<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Orderotp extends Model
{
    public $timestamps = false;
    protected $table = 'order_details_otp';
    protected $primaryKey = 'odt_id';

    protected $fillable = [
        'odt_order_id',
        'odt_delivery_id',
        'odt_otp',
        'odt_is_verify',
        'odt_created_at'   
    ];

    protected $guarded = [];


}