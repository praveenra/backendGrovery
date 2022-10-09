<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Contactus extends Model
{
    public $timestamps = false;
    protected $table = 'contact_us';
    protected $primaryKey = 'id';

    protected $fillable = [
        'email',
        'phone_no',
        'address',
        'facebook',
        'instagram',
        'whatsapp',
        'status',
        'created_by',
        'updated_by',
        'twitter',   
    ];

    protected $guarded = [];


}