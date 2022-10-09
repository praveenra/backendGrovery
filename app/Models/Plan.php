<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Plan extends Model
{
    public $timestamps = false;
    protected $table = 'membership_plan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'plan_name',
        'plan_duration',
        'plan_status',
        'plan_amount',
        'description',
        'created_by',
        'updated_by',       
    ];

    protected $guarded = [];


}