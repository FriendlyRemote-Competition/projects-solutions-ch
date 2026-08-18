<?php

namespace App\Http\Controllers;

use App\Http\Requests\LineRequest;
use App\Models\Line;
use Illuminate\Http\Request;

class AdminLineController extends Controller
{
    public function store(LineRequest $request)
    {
        $line = Line::create(array_merge(
            $request->safe()->only("station_a_code", "station_b_code", "seat_capacity", "crossing_minutes", "fare_cny"),
            ["line_code" => $request->code, "line_name" => $request->name, "line_status" => $request->status],
        ));

        return response()->json(["data" => $line->toResource()], 201);
    }

    public function update(LineRequest $request, Line $line)
    {
        // TODO seat_capacity validaiton

        $line->update(array_merge(
            $request->safe()->only("station_a_code", "station_b_code", "seat_capacity", "crossing_minutes", "fare_cny"),
            ["line_name" => $request->name, "line_status" => $request->status],
        ));

        return $line->toResource();
    }
}
