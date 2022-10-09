<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Pages extends Model
{
    public $timestamps = false;
    protected $table = 'pages';
    protected $primaryKey = 'id';

    protected $fillable = [
        'page_type',
        'page_name',
        'page_description',
        'page_status',
        'created_by',
        'updated_by',       
    ];

    protected $guarded = [];


}