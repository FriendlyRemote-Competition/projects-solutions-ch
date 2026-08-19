<?php

namespace App\Http\Controllers;

use App\Helpers\Departure;
use App\Models\CancelledDeparture;
use App\Models\Line;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LineTimetableController extends Controller
{
    /**
     * Show all depatures for a given line. Can be filtered by date and station.
     */
    public function index(Request $request, Line $line)
    {
        $request->validate([
            "date" => "nullable|date_format:Y-m-d",
            "station" => "nullable|exists:stations,station_code",
        ]);
        if ($request->station && !$line->station_a()->find($request->station) && !$line->station_b()->find($request->station)) {
            return response()->json(["message" => "Validation failed", "errors" => ["station" => "Station does not belong to line"]], 422);
        }

        if ($line->line_status == 'suspended') {
            return response()->json([]);
        }
        return response()->json(["data" => Departure::get_departures($line, Carbon::parse($request->query("date", today())), $request->query("station", null))]);
    }
}
