<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\ServiceWindow;
use Illuminate\Http\Request;

class AdminLineServiceWindowController extends Controller
{
    /**
     * Create a service window for a line as an admin.
     */
    public function store(Request $request, Line $line)
    {
        $request->validate([
            "start_time" => "required|date_format:H:i",
            "end_time" => "required|date_format:H:i|after:start_time",
            "interval_minutes" => "required|integer|min:" . $line->crossing_minutes . "|max:120",
        ]);

        // Check if service window is overlapping another in the line.
        if ($line->service_windows()->where("service_start", ">=", $request->start_time)->where("service_end", "<=", $request->end_time)->exists()){
            return response()->json(["message" => "Service window overlaps an existing window"], 422);
        }

        $service_window = $line->service_windows()->create([
            "service_start" => $request->start_time,
            "service_end" => $request->end_time,
            "interval_minutes" => $request->interval_minutes,
        ]);

        return response()->json($request->all(), 201);
    }

    /**
     * Delete a service window for a line as an admin.
     */
    public function delete(Request $request, Line $line, string $start_time)
    {
        $serviceWindow = $line->service_windows()->where("service_start", $start_time)->first();

        if (!$serviceWindow) {
            return response()->json(["message" => "Resource not found"], 404);
        }

        $serviceWindow->delete();

        return response()->json(["message" => "Service window deleted"]);
    }
}
