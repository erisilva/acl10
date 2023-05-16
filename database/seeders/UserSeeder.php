<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'adm@mail.com',
            'active' => 'Y',
            'password' => Hash::make('123456'),
            'theme_id' => 1,
            'email_verified_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Gerente',
            'email' => 'gerente@mail.com',
            'active' => 'Y',
            'password' => Hash::make('123456'),
            'theme_id' => 1,
            'email_verified_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Operador',
            'email' => 'operador@mail.com',
            'active' => 'Y',
            'password' => Hash::make('123456'),
            'theme_id' => 1,
            'email_verified_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Leitor',
            'email' => 'leitor@mail.com',
            'active' => 'Y',
            'password' => Hash::make('123456'),
            'theme_id' => 1,
            'email_verified_at' => now(),
        ]);

    }
}
