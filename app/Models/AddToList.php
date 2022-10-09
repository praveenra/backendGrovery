<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddToList extends Model
{
    public $timestamps = false;
    protected $table = "add_to_list";
    protected $fillable = [
        'store_id',
        'product_id',
        'product_category_id'
    ];
}
