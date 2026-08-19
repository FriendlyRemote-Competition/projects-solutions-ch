<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["DCL", "Dongchang Road", "Pudong", "Pudong New Area", "1 Dongchang Road"],
            ["DJD", "Dongjiadu", "Puxi", "Huangpu", "5 Waima Road"],
            ["FXR", "Fuxing Road", "Puxi", "Huangpu", "465 Zhongshan East No.2 Road"],
            ["GPR", "Gongping Road", "Puxi", "Hongkou", "1 Gongping Road"],
            ["JLE", "Jinling East Road", "Puxi", "Huangpu", "127 Zhongshan East No.2 Road"],
            ["LJZ", "Lujiazui", "Pudong", "Pudong New Area", "1 Fenghe Road"],
            ["MLR", "Meilin Road", "Pudong", "Pudong New Area", "218 Meilin Road"],
            ["NMT", "Nanmatou", "Pudong", "Pudong New Area", "3588 Pudong South Road"],
            ["QCZ", "Qichangzhan", "Pudong", "Pudong New Area", "2477 Binjiang Avenue"],
            ["TQO", "Tangqiao", "Pudong", "Pudong New Area", "2588 Binjiang Avenue"],
            ["TTZ", "Taitongzhan", "Pudong", "Pudong New Area", "1500 Binjiang Avenue"],
            ["YSP", "YangshupuRoad", "Puxi", "Yangpu", "1088 Yangshupu Road"],
        ];

        foreach ($data as $row) {
            Station::create([
                "station_code" => $row[0],
                "station_name" => $row[1],
                "bank" => $row[2],
                "district" => $row[3],
                "address" => $row[4],
            ]);
        }
    }
}
