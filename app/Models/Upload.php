<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Upload extends Model
{
  //  use LogsActivity;
    public $incrementing = true;
    public $timestamps = false;

    protected $table = "upload_files";
    protected $primaryKey = "id";
    protected $perPage = 25; 

    
    protected $fillable = [
        'image_name',
        'product_id',
        'created_by',
        'updated_by',


    ];

    protected $dates = ['created_at', 'updated_at'];
  //  protected static $recordEvents = ['created','updated'];

  }
