<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HousingProfileQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            // seção: infraestutura e moradia
            [
                'question' => 'Sua rua é asfaltada?',
                'section_id' => 1
            ],
            [
                'question' => 'Sua rua é bem iluminada durante a noite?',
                'section_id' => 1
            ],
            [
                'question' => 'Sua casa é construída com alvenaria (tijolo e cimento)?',
                'section_id' => 1
            ],
            [
                'question' => 'A casa onde você mora é própria, alugada ou cedida?',
                'section_id' => 1
            ],
            // seção: acesso a serviços
            [
                'question' => 'A sua casa possui acesso à rede elétrica?',
                'section_id' => 2
            ],
            [
                'question' => 'A água da sua casa vem da rede pública?',
                'section_id' => 2
            ],
            [
                'question' => 'Existe coleta de lixo regular na sua comunidade?',
                'section_id' => 2
            ],
            [
                'question' => 'Há esgoto canalizado ou fossa séptica em sua residência?',
                'section_id' => 2
            ],
             // seção: mobilidade e Acessibilidade
            [
                'question' => 'A rua onde você mora permite o acesso de veículos?',
                'section_id' => 3
            ],
            [
                'question' => 'Você tem fácil acesso a transporte público próximo da sua casa?',
                'section_id' => 3
            ],
            [
                'question' => 'Há calçadas na sua rua?',
                'section_id' => 3
            ],
            // seção: Segurança
            [
                'question' => 'Você se sente seguro na sua comunidade durante o dia?',
                'section_id' => 4
            ],
            [
                'question' => 'E durante a noite?',
                'section_id' => 4
            ],
            [
                'question' => 'Existem postes de luz funcionando em sua rua?',
                'section_id' => 4
            ],
            // seção Condições Ambientais
            [
                'question' => 'Sua casa costuma alagar em períodos de chuva?',
                'section_id' => 5
            ],
            [
                'question' => 'Há áreas com acúmulo de lixo ou entulho próximas à sua residência?',
                'section_id' => 5
            ],
            [
                'question' => 'Há saneamento básico adequado na sua rua?',
                'section_id' => 5
            ],
            // seção Convivência na Comunidade
            [
                'question' => 'Há espaços de convivência (praças, áreas de lazer) próximos da sua casa?',
                'section_id' => 6
            ],
            [
                'question' => 'Existem organizações comunitárias ou associações de moradores ativas na sua região?',
                'section_id' => 6
            ],

        ];

        DB::table('housing_profiles')->insert($questions);
    }
}
