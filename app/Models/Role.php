<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
 
    public $timestamps = false;
    protected $table = "roles";

    public function permissions() {
		return $this->belongsToMany('App\Models\Permission');
	}
 
}