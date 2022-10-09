<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class AreaBanner extends Model
{
    public $timestamps = false;
    protected $table = 'area_banner';
    protected $primaryKey = 'ab_id';

    protected $fillable = [
        'ab_area_id',
        'ab_name',
        'ab_image',
        'ab_status',
        'created_by',
        'updated_by',       
    ];

    protected $guarded = [];

    public static function allcities()
    {
        return  Area::pluck('area_name','area_id')->all();      
    }

    public function areabanner(){
        return $this->belongsTo('App\Models\Area','ab_area_id','area_id')->where('area_status','1');
    }
    public function SliderImage(){
        if ($this->ab_image) {
            return url('http://ibotix.tech/Grovery/admin/images'.'/'.$this->ab_image);
        } else {
            return url('admin/img/default_image.png');
        }
    }

}