<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    protected $primaryKey = "line_code";
    protected $keyType = 'string';
    public $timestamps = false;

    public function station_a()
    {
        return $this->belongsTo(Station::class, "station_a_code");
    }

    public function station_b()
    {
        return $this->belongsTo(Station::class, "station_b_code");
    }

    public function service_windows()
    {
        return $this->hasMany(ServiceWindow::class, "line_code");
    }
}
