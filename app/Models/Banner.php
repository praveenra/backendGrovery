<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Banner extends Model
{
  //  use LogsActivity;

  public $timestamps = false;
    protected $table = "banner";
    protected $primaryKey = "banner_id";
    protected $perPage = 25; 

    
    protected $fillable = [
        'banner_name',
        'banner_image',
        'banner_status',
        'created_by',
        'updated_by',

    ];

    //protected $dates = ['created_at', 'updated_at'];
  //  protected static $recordEvents = ['created','updated'];


  public function SliderImage(){
    if ($this->banner_image) {
        return url('http://ibotix.tech/Grovery/admin/images'.'/'.$this->banner_image);
    } else {
        return url('admin/img/default_image.png');
    }
}


  }
