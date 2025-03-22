<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([

    ['nombre' => 'Michoacán'],
   
    ['nombre' => 'Jalisco'],
    ['nombre' => 'Veracruz'],
    ['nombre' => 'Turre'],

        ]);
    }
}
