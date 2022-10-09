<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Brand extends Model
{
  //  use LogsActivity;
    public $incrementing = true;
    public $timestamps = false;

    protected $table = "brand";
    protected $primaryKey = "id";
    protected $perPage = 25; 

    
    protected $fillable = [
        'category',
        'brand_name',
        'brand_status',


    ];

    protected $dates = ['created_at', 'updated_at'];
  //  protected static $recordEvents = ['created','updated'];

	
	public static function allbrand()
		{
			return  Brand::where('brand_status','=',0)->pluck('brand_name','id')->all();      
		}
	
  }
