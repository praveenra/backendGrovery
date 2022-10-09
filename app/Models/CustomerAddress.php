<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    public $timestamps = false;
    protected $table = 'customer_addresses';

    protected $fillable = [
        'customer_id',
        'address',
        'area'
    ];




	public function area(){
		$query = $this->belongsTo('App\Models\Area','area','area_id')->select('area_id','area_name');
        return $query ;
	}

}
