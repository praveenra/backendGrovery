<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
  //  use LogsActivity;
    public $incrementing = true;
    public $timestamps = false;

    protected $table = "category";
    protected $primaryKey = "cat_id";
    protected $perPage = 25; 

    
    protected $fillable = [
        'cat_is_parent_id',
        'cat_name',
        'cat_image',
        'cat_status',
        'created_by',
        'updated_by',


    ];

    protected $dates = ['created_at', 'updated_at'];
  //  protected static $recordEvents = ['created','updated'];

  public function subcategory(){
    return $this->belongsTo('App\Models\Category','cat_is_parent_id','cat_id');
}

public static function allcategory()
{
    return  Category::where('cat_is_parent_id','=',null)->pluck('cat_name','cat_id')->all();      
}

public static function allsubcategory()
{
    return  Category::where('cat_is_parent_id','!=',null)->pluck('cat_name','cat_id')->all();      
}
public function SliderImage(){
    if ($this->cat_image) {
        return url('http://ibotix.tech/Grovery/admin/images'.'/'.$this->cat_image);
    } else {
        return url('admin/img/default_image.png');
    }
}

  }
