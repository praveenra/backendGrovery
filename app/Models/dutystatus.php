<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class dutystatus extends Model
{
    public $timestamps = false;
    protected $table = 'duty_status';
    protected $primaryKey = 'ds_id';

    protected $fillable = [
        'ds_date',
        'ds_user_id',
        'ds_status',
        'ds_created_at'      
    ];

    protected $guarded = [];


}