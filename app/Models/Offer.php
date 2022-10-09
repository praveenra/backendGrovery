<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class offer extends Model
{
    public $timestamps = false;
    protected $table = 'offer';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'amount',
        'offer_condition',
        'description',
        'code',
        'amount_limit',
        'main_category',
        'status',
        'created_by',
        'updated_by',       
    ];

    protected $guarded = [];


    public function main_categories() {
        return $this->belongsToMany('App\Models\Maincategory');
    }

    public function sellers() {
        return $this->belongsToMany('App\Models\Seller');
    }

    public function products() {
        return $this->belongsToMany('App\Models\Products');
    }

    public function sub_categories() {
        return $this->belongsToMany('App\Models\Category');
    }

}