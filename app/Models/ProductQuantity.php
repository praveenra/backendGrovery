<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ProductQuantity extends Model
{
  //  use LogsActivity;
    public $incrementing = true;
    public $timestamps = false;

    protected $table = "product_quantity";
    protected $primaryKey = "id";
    protected $fillable = [
      'product_id',
      'availability',
      'measurement',
      'price',
      'sales_price',
      'offer',
      'quantity',
  
  ];

  }
