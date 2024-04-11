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
            'name' => 'Comando de Inteligencia Militar Conjunto',
            'abbreviation' => 'COIMC',
            'address' => 'Av Huancavilca y Chillo Jijón',
            'commander' => 'Crnl de EMC Carphio Francisco',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MilitaryUnit::create([
            'name' => 'Grupo de Monitoreo y Reconocimiento Elecrónico Conjunto',
            'abbreviation' => 'GMREC',
            'address' => 'Av Huancavilca y Chillo Jijón',
            'commander' => 'Tcrn de EM Hernandez Miguel',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MilitaryUnit::create([
            'name' => 'Grupo Especial de Operaciones ECUADOR',
            'abbreviation' => 'GEO',
            'address' => 'Av Huancavilca y Chillo Jijón',
            'commander' => 'Tcrn de EM Hidalgo Iván',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MilitaryUnit::create([
            'name' => 'Unidad Escuela Misiones de Paz Ecuador',
            'abbreviation' => 'UEMPE',
            'address' => 'Av Huancavilca y Chillo Jijón',
            'commander' => 'Tcrn de EM Zambrano Alex',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
