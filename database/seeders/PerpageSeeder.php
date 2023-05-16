<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerpageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perpages')->insert([
            'valor' => 5,
            'nome' => 'Mostrar 5 resultados',
        ]);
        DB::table('perpages')->insert([
            'valor' => 10,
            'nome' => 'Mostrar 10 resultados',
        ]);
        DB::table('perpages')->insert([
            'valor' => 15,
            'nome' => 'Mostrar 15 resultados',
        ]);
        DB::table('perpages')->insert([
            'valor' => 20,
            'nome' => 'Mostrar 20 resultados',
        ]);
        DB::table('perpages')->insert([
            'valor' => 30,
            'nome' => 'Mostrar 30 resultados',
        ]);
        DB::table('perpages')->insert([
            'valor' => 40,
            'nome' => 'Mostrar 40 resultados',
        ]);
        DB::table('perpages')->insert([
            'valor' => 50,
            'nome' => 'Mostrar 50 resultados',
        ]);
            DB::table('perpages')->insert([
            'valor' => 100,
            'nome' => 'Mostrar 100 resultados',
        ]);
    }
}
