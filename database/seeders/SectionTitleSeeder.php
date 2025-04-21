<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            ['section_title' => 'Infraestrutura da Moradia'],
            ['section_title' => 'Acesso a Serviços'],
            ['section_title' => 'Mobilidade e Acessibilidade'],
            ['section_title' => 'Segurança'],
            ['section_title' => 'Condições Ambientais'],
            ['section_title' => ' Convivência na Comunidade']
        ];

        DB::table('section_title')->insert($titles);
    }
}
