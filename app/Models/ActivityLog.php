<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class ActivityLog extends Model
{
    public $timestamps = false;

    protected $table = "activity_logs";
  }