<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $primaryKey = "line_code";
    protected $keyType = 'string';
    public $timestamps = false;
}
