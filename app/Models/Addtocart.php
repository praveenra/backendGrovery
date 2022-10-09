<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Addtocart extends Model
{
  //  use LogsActivity;
    public $incrementing = true;
    public $timestamps = false;

    protected $table = "add_tocart";
    protected $primaryKey = "id";
    
    protected $fillable = [
        'store_id',
        'product_id',
		
    ];

  }
