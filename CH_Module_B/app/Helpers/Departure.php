<?php

namespace App\Helpers;

use App\Models\Line;
use Carbon\Carbon;

class Departure
{
  public static function get_departures(Line $line, Carbon|null $date = null, string|null $station_code = null)
  {
    if (!$date) $date = today();

    $departures = [];

    foreach ($line->service_windows()->orderBy("service_start")->get() as $sw) {
      $time = Carbon::parse($sw->service_start);
      $end_time = Carbon::parse($sw->service_end);
      while ($time < $end_time) {
        foreach (collect([$line->station_a, $line->station_b])->sortBy(fn($s) => $s['station_code']) as $station) {
          if ($station_code && $station->station_code != $station_code) {
            continue;
          }
          $cancelled_depature = $line->cancelled_departures()->where("departure_station", $station->station_code)->where("departure_time", $time)->where("departure_date", $date)->first();
          $bookings_count = $line->bookings()->where("departure_station", $station->station_code)->where("departure_time", $time)->where("departure_date", $date)->count();
          $departures[] = [
            "code" => $station->station_code . "-" . $date->format("Ymd") . "-" . $time->format("Hi") . "-" . $line->line_code,
            "origin" => ["code" => $station->station_code, "name" => $station->station_name],
            "destination" => $line->station_b_code == $station->station_code ? ["code" => $line->station_a->station_code, "name" => $line->station_a->station_name] : ["code" => $line->station_b->station_code, "name" => $line->station_b->station_name],
            "departure_date" => $date->format("Y-m-d"),
            "departure_time" => $time->format("H:i"),
            "arrival_time" => $time->copy()->addMinutes($line->crossing_minutes)->format("H:i"),
            "seats_booked" => $bookings_count,
            "seats_available" => $line->seat_capacity - $bookings_count,
            "status" => $cancelled_depature ? "cancelled" : ($date < today() || ($date == today() && $time < now()) ? "departed" : "scheduled"),
            "cancellation_reason" => $cancelled_depature?->reason,
          ];
        }
        $time->addMinutes($sw->interval_minutes);
      }
    }

    return collect($departures);
  }
}
