<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'description' => 'Administrador',
        ]);

        DB::table('roles')->insert([
            'name' => 'gerente',
            'description' => 'Gerente',
        ]);

        DB::table('roles')->insert([
            'name' => 'operador',
            'description' => 'Operador',
        ]);

        DB::table('roles')->insert([
            'name' => 'leitor',
            'description' => 'Leitor',
        ]);
    }
}
