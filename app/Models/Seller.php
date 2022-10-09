<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Seller extends Model
{
  //  use LogsActivity;
    public $incrementing = true;
    public $timestamps = false;

    protected $table = "seller_details";
    protected $primaryKey = "sd_id";
    protected $perPage = 25; 

    
    protected $fillable = [
        'sd_usid',
        'sd_sname',
        'main_category',
        'sd_snumber',
        'sd_sadminshare',
        'sd_scityid',
        'sd_zone_id',
        'sd_sdeliverykm',
        'sd_spincode',
        'sd_address',
        'sd_status',
        'sd_lat',
        'sd_lng',
        'tag',
        'created_by',
        'updated_by',
        'sd_business',
        'sunday_check',
        'monday_check',
        'tuesday_check',
        'wednesday_check',
        'thursday_check',
        'friday_check',
        'saturday_check',
        'sunday_opening_time',
        'sunday_closing_time',
        'monday_opening_time',
        'monday_closing_time',
        'tuesday_opening_time',
        'tuesday_closing_time',
        'wednesday_opening_time',
        'wednesday_closing_time',
        'thursday_opening_time',
        'thursday_closing_time',
        'friday_opening_time',
        'friday_closing_time',
        'saturday_opening_time',
        'saturday_closing_time',
    ];

    protected $dates = ['created_at', 'updated_at'];
  //  protected static $recordEvents = ['created','updated'];

  public function userseller(){
    return $this->belongsTo('App\Models\User','sd_usid','id')->where('pa_status','1');
}





  }
