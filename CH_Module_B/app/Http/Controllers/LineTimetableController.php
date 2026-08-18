<?php

namespace App\Http\Controllers;

use App\Models\CancelledDeparture;
use App\Models\Line;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LineTimetableController extends Controller
{
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
        return response()->json($line->service_windows()->orderBy("service_start")->get()->map(function ($sw) use ($request, $line) {
            $time = Carbon::parse($sw->service_start);
            $end_time = Carbon::parse($sw->service_end);
            $departures = [];
            $departure_date = Carbon::parse($request->query("date", today()));
            while ($time < $end_time) {
                foreach (collect([$line->station_a, $line->station_b])->sortBy(fn ($s) => $s['station_code']) as $station) {
                    if ($request->query("station", false) && $station->station_code != $request->query("station")) {
                        continue;
                    }
                    $cancelled_depature = $line->cancelled_departures()->where("departure_station", $station->station_code)->where("departure_time", $time)->where("departure_date", $departure_date)->first();
                    $bookings_count = $line->bookings()->where("departure_station", $station->station_code)->where("departure_time", $time)->where("departure_date", $departure_date)->count();
                    $departures[] = [
                        "code" => $station->station_code . "-" . Carbon::parse($request->query("date", today()))->format("Ymd") . "-" . $time->format("Hi") . "-" . $line->line_code,
                        "origin" => ["code" => $station->station_code, "name" => $station->station_name],
                        "destination" => $line->station_b_code == $station->station_code ? ["code" => $line->station_a->station_code, "name" => $line->station_a->station_name] : ["code" => $line->station_b->station_code, "name" => $line->station_b->station_name],
                        "departure_date" => $departure_date->format("Y-m-d"),
                        "departure_time" => $time->format("H:i"),
                        "arrival_time" => $time->copy()->addMinutes($line->crossing_minutes)->format("H:i"),
                        "seats_booked" => $bookings_count,
                        "seats_available" => $line->seat_capacity - $bookings_count,
                        "status" => $cancelled_depature ? "cancelled" : ($departure_date < today() || ($departure_date == today() && $time < now()) ? "departed" : "scheduled"),
                        "cancellation_reason" => $cancelled_depature?->reason,
                    ];
                }
                $time->addMinutes($sw->interval_minutes);
            }
            return $departures;
        }));
    }
}
