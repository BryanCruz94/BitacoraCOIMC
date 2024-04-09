<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Ranks_Seeder extends Seeder
{
   /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $data = [
        ['id' => 1, 'name' => 'S.P', 'code' => 1],
        ['id' => 2, 'name' => 'SLDO', 'code' => 2],
        ['id' => 3, 'name' => 'CBOS', 'code' => 3],
        ['id' => 4, 'name' => 'CBOP', 'code' => 4],
        ['id' => 5, 'name' => 'SGOS', 'code' => 5],
        ['id' => 6, 'name' => 'SGOP', 'code' => 6],
        ['id' => 7, 'name' => 'SUBS', 'code' => 7],
        ['id' => 8, 'name' => 'SUBP', 'code' => 8],
        ['id' => 9, 'name' => 'SUBM', 'code' => 9],
        ['id' => 10, 'name' => 'SUBT', 'code' => 10],
        ['id' => 11, 'name' => 'TNTE', 'code' => 11],
        ['id' => 12, 'name' => 'CAPT', 'code' => 12],
        ['id' => 13, 'name' => 'MAYO', 'code' => 13],
        ['id' => 14, 'name' => 'TCRN', 'code' => 14],
        ['id' => 15, 'name' => 'CRNL', 'code' => 15],
        ['id' => 16, 'name' => 'GRAB', 'code' => 16],
    ];

    DB::table('ranks')->insert($data);

    }
}
