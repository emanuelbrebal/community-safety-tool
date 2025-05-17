<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UrgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $urgencies = [
            [

                'urgency' => 'Baixa',
                'description' => 'Situações que não requerem ação imediata e representam pouco ou nenhum risco.'
            ],
            [

                'urgency' => 'Média',
                'description' => 'Incidentes que exigem atenção, mas não são emergenciais.'
            ],
            [

                'urgency' => 'Alta',
                'description' => 'Situações graves que requerem ação rápida, mas sem risco iminente de vida.'
            ],
            [

                'urgency' => 'Crítica',
                'description' => 'Emergências que colocam vidas em risco e exigem resposta imediata.'
            ],
        ];

        DB::table('urgency')->insert($urgencies);
    }
}
