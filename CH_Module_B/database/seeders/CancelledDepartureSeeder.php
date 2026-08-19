<?php

namespace Database\Seeders;

use App\Models\CancelledDeparture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CancelledDepartureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["QF", "2026-08-19", "08:30", "QCZ", "Vessel maintenance", "2026-08-18T06:10:00+08:00"],
            ["TD", "2026-08-19", "09:00", "DJD", "Vessel swap at Tangqiao", "2026-08-18T07:40:00+08:00"],
            ["TD", "2026-08-20", "14:00", "DJD", "Vessel maintenance", "2026-08-15T14:00:00+08:00"],
        ];

        foreach ($data as $row) {
            CancelledDeparture::create([
                "line_code" => $row[0],
                "departure_date" => $row[1],
                "departure_time" => $row[2],
                "departure_station" => $row[3],
                "reason" => $row[4],
                "cancelled_at" => $row[5],
            ]);
        }
    }
}
