<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('themes')->insert([
            'name' => 'Padrão',
            'description' => 'Tema padrão do Bootstrap',
            'filename' => 'bootstrap.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Cerulean',
            'description' => 'Um céu azul calmo',
            'filename' => 'bootstrap.cerulean.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Darkly',
            'description' => 'Planície no modo noturno',
            'filename' => 'bootstrap.darkly.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Litera',
            'description' => 'O meio é a mensagem',
            'filename' => 'bootstrap.litera.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Materia',
            'description' => 'O material é a metáfora',
            'filename' => 'bootstrap.materia.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Pulse',
            'description' => 'Um traço de roxo',
            'filename' => 'bootstrap.pulse.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Simplex',
            'description' => 'Mini e minimalista',
            'filename' => 'bootstrap.simplex.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Solar',
            'description' => 'Um giro no Solarized',
            'filename' => 'bootstrap.solar.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'United',
            'description' => 'Ubuntu laranja e fonte única',
            'filename' => 'bootstrap.united.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Zephyr',
            'description' => 'Alegre e lindo',
            'filename' => 'bootstrap.zephyr.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Cosmo',
            'description' => 'Uma ode a métrica',
            'filename' => 'bootstrap.cosmo.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Flatly',
            'description' => 'Plano e moderno',
            'filename' => 'bootstrap.flatly.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Lumen',
            'description' => 'Luz e sombra',
            'filename' => 'bootstrap.lumen.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Minty',
            'description' => 'Uma sensação fresca',
            'filename' => 'bootstrap.minty.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Quartz',
            'description' => 'Uma camada vítrea',
            'filename' => 'bootstrap.quartz.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Sketchy',
            'description' => 'Um visual desenhado à mão para maquetes e alegria',
            'filename' => 'bootstrap.sketchy.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Spacelab',
            'description' => 'Prateado e elegante',
            'filename' => 'bootstrap.spacelab.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Vapor',
            'description' => 'Uma estética cyberpunk',
            'filename' => 'bootstrap.vapor.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Cyborg',
            'description' => 'Preto azeviche e azul elétrico',
            'filename' => 'bootstrap.cyborg.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Journal',
            'description' => 'Revigorante como uma nova folha de papel',
            'filename' => 'bootstrap.journal.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'LUX',
            'description' => 'Um toque de classe',
            'filename' => 'bootstrap.lux.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Morph',
            'description' => 'Uma camada neumórfica',
            'filename' => 'bootstrap.morph.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Sandstone',
            'description' => 'Um toque de calor',
            'filename' => 'bootstrap.sandstone.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Slate',
            'description' => 'Tons de cinza metalizado',
            'filename' => 'bootstrap.slate.min.css',
        ]);

        DB::table('themes')->insert([
            'name' => 'Superhero',
            'description' => 'O corajoso e o azul',
            'filename' => 'bootstrap.superhero.min.css',
        ]);  

        DB::table('themes')->insert([
            'name' => 'Yeti',
            'description' => 'Uma base amigável',
            'filename' => 'bootstrap.yeti.min.css',
        ]); 
    }
}
