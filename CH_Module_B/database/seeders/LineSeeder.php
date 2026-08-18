<?php

namespace Database\Seeders;

use App\Models\Line;
use App\Models\ServiceWindow;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["DJ", "Dongjin Line", "active", "DCL", "Dongchang Road", "JLE", "Jinling East Road", 48, 8, 2.00, "06:00", "08:59", 10],
            ["DJ", "Dongjin Line", "active", "DCL", "Dongchang Road", "JLE", "Jinling East Road", 48, 8, 2.00, "09:00", "15:59", 20],
            ["DJ", "Dongjin Line", "active", "DCL", "Dongchang Road", "JLE", "Jinling East Road", 48, 8, 2.00, "16:00", "18:59", 10],
            ["DJ", "Dongjin Line", "active", "DCL", "Dongchang Road", "JLE", "Jinling East Road", 48, 8, 2.00, "19:00", "23:59", 20],
            ["QF", "Qifu Line", "active", "QCZ", "Qichangzhan", "FXR", "Fuxing Road", 36, 10, 2.00, "06:30", "09:29", 12],
            ["QF", "Qifu Line", "active", "QCZ", "Qichangzhan", "FXR", "Fuxing Road", 36, 10, 2.00, "09:30", "16:59", 20],
            ["QF", "Qifu Line", "active", "QCZ", "Qichangzhan", "FXR", "Fuxing Road", 36, 10, 2.00, "17:00", "19:29", 12],
            ["QF", "Qifu Line", "active", "QCZ", "Qichangzhan", "FXR", "Fuxing Road", 36, 10, 2.00, "19:30", "23:59", 30],
            ["TG", "Taigong Line", "active", "TTZ", "Taitongzhan", "GPR", "Gongping Road", 24, 7, 2.00, "06:00", "08:59", 15],
            ["TG", "Taigong Line", "active", "TTZ", "Taitongzhan", "GPR", "Gongping Road", 24, 7, 2.00, "09:00", "17:59", 30],
            ["TG", "Taigong Line", "active", "TTZ", "Taitongzhan", "GPR", "Gongping Road", 24, 7, 2.00, "18:00", "20:59", 15],
            ["ND", "Nandong Line", "active", "NMT", "Nanmatou", "DJD", "Dongjiadu", 40, 9, 2.00, "06:15", "20:15", 15],
            ["TD", "Tangdong Line", "active", "TQO", "Tangqiao", "DJD", "Dongjiadu", 20, 12, 2.00, "07:00", "19:00", 30],
            ["LT", "Lantern Line", "active", "LJZ", "Lujiazui", "JLE", "Jinling East Road", 60, 25, 25.00, "18:30", "22:30", 45],
            ["PY", "Puyang Line", "suspended", "MLR", "Meilin Road", "YSP", "Yangshupu Road", 30, 11, 2.00, "06:30", "19:30", 20],
        ];

        foreach ($data as $row) {
            if (!Line::find($row[0])) {
                Line::create([
                    "line_code" => $row[0],
                    "line_name" => $row[1],
                    "line_status" => $row[2],
                    "station_a_code" => $row[3],
                    "station_b_code" => $row[5],
                    "seat_capacity" => $row[7],
                    "crossing_minutes" => $row[8],
                    "fare_cny" => $row[9],
                ]);
            }
            ServiceWindow::create([
                "line_code" => $row[0],
                "service_start" => $row[10],
                "service_end" => $row[11],
                "interval_minutes" => $row[12],
            ]);
        }
    }
}
