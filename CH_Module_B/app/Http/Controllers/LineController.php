<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use App\Http\Resources\LineResource;

class LineController extends Controller
{
    public function index()
    {
        return LineResource::collection(Line::all());   
    }

    public function show(Line $line)
    {
        return $line->toResource();
    }
}
