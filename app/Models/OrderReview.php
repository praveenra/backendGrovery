<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class OrderReview extends Model
{
    public $timestamps = false;
    protected $table = 'order_review';
    protected $primaryKey = 'or_id';

    protected $fillable = [
        'or_order_id',
        'or_product_id',
        'or_status',
        'or_reason',
        'or_amount',
        'or_date',
        'or_created_by', 
        'updated_at'      
    ];

    protected $guarded = [];


}