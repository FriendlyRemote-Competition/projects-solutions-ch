<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "code" => $this->line_code,
            "name" => $this->line_name,
            "status" => $this->line_status,
            "station_a" => [
                "code" => $this->station_a->station_code,
                "name" => $this->station_a->station_name,
            ],
            "station_b" => [
                "code" => $this->station_b->station_code,
                "name" => $this->station_b->station_name,
            ],
            "seat_capacity" => $this->seat_capacity,
            "crossing_minutes" => $this->crossing_minutes,
            "fare_cny" => $this->fare_cny,
            "service_windows" => $this->service_windows()->orderBy("service_start")->get()->map(fn($w) => [
                "start_time" => substr($w->service_start, 0, 5),
                "end_time" => substr($w->service_end, 0, 5),
                "interval_minutes" => $w->interval_minutes,
            ]),
        ];
    }
}
