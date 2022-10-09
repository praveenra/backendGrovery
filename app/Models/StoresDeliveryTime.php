<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoresDeliveryTime extends Model
{
    use HasFactory;
    protected $table = 'stores_deliv_times';
    protected $primaryKey = 'id';

    protected $fillable = [
        'store_id',
        'delivery_time',
        'delivery_day',
        'created_at',
        'updated_at',       
    ];
}
