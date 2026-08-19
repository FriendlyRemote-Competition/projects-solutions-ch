<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["admin1@hpferry.cn","admin123","Zhu Hai","admin",1],
            ["admin2@hpferry.cn","admin123","Ivana Kral","admin",1],
            ["dispatch1@hpferry.cn","dispatch123","Mo Chen","dispatcher",1],
            ["dispatch2@hpferry.cn","dispatch123","Lars Holm","dispatcher",0],
        ];

        foreach ($data as $row) {
            User::create([
                "email" => $row[0],
                "password" => Hash::make($row[1]),
                "name" => $row[2],
                "role" => $row[3],
                "is_active" => $row[4],
            ]);
        }
    }
}
