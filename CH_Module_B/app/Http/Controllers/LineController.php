<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Line;
use App\Http\Resources\LineResource;

class LineController extends Controller
{
    /**
     * List all lines
     */
    public function index()
    {
        return LineResource::collection(Line::all());   
    }

    /**
     * Show a specific line
     */
    public function show(Line $line)
    {
        return $line->toResource();
    }
}
