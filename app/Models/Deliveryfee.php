<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryfee extends Model
{
    use HasFactory;



    public $timestamps = false;
    protected $table = 'deliveryfee';
    protected $primaryKey = 'id';

    protected $fillable = [
        'from_distance',  
        'to_distance',  
        'delivery_fee', 
        'delivery_id', 
    ];

}
