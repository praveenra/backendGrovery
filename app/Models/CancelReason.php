<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelReason extends Model
{

      //  use LogsActivity;
    public $incrementing = true;
    public $timestamps = false;

    protected $table = "cancel_reasons";
    protected $primaryKey = "id";
    protected $perPage = 25; 

    
    protected $fillable = [
        'cancel_reason',
        'status',


    ];

    protected $dates = ['created_at', 'updated_at'];
  //  protected static $recordEvents = ['created','updated'];
	
}