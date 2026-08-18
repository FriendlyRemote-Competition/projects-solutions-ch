<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = "booking_code";
    protected $keyType = 'string';
    public $timestamps = false;
    protected $guarded = [];
}
