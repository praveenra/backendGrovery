<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
  //  use LogsActivity;
    public $incrementing = true;
    public $timestamps = false;

    protected $table = "product";
    protected $primaryKey = "product_id";
    protected $perPage = 25; 

    
    protected $fillable = [
        'product_name',
        'product_category_id',
        'product_short_description',
        'product_long_description',
        'product_stock',
        'product_tax',
        'main_image',
        'product_status',
        'created_by',
        'updated_by',
        'seller_id',
        'sub_category_id',
        'sub_sub_category_id',
        'brand_id',
        'productColor',
        'productSize'
		
    ];

    protected $dates = ['created_at', 'updated_at'];
  //  protected static $recordEvents = ['created','updated'];

  public function product_category(){
    return $this->belongsTo('App\Models\Category','product_category_id','cat_id');
}



  }
