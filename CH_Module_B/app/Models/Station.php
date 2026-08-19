<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $primaryKey = "station_code";
    protected $keyType = 'string';
    public $timestamps = false;
}
