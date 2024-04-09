<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MilitaryUnit;

class Military_Unit_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MilitaryUnit::create([
            'name' => 'Test Military Unit',
            'abbreviation' => 'Test Military Unit',
            'address' => 'Test Military Unit',
            'commander' => 'Test Military Unit',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
