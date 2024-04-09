<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'names' => 'Test User',
            'last_names' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'identification_card' => '123456789',
            'phone' => '123456789',
            'rank_id' => 1,
            'military_unit_id' => 1,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            ])->assignRole('Admin');

        //Se crean 5 usuarios de prueba
        //User::factory(5)->create();

    }
}
