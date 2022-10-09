<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Settings extends Model
{
  //  use LogsActivity;
    public $incrementing = true;
    public $timestamps = false;

    protected $table = "settings";
    protected $primaryKey = "s_id";
    protected $perPage = 25; 

    
    protected $fillable = [
        's_name',
        's_content',
        's_status',
        'created_by',
        'updated_by',

    ];

   // protected $dates = ['created_at', 'updated_at'];
  //  protected static $recordEvents = ['created','updated'];



  }
