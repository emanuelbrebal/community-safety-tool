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
                'check' => false,
                'section_id' => 1
            ],
            [
                'question' => 'Sua rua é bem iluminada durante a noite?',
                'check' => false,
                'section_id' => 1
            ],
            [
                'question' => 'Sua casa é construída com alvenaria (tijolo e cimento)?',
                'check' => false,
                'section_id' => 1
            ],
            [
                'question' => 'A casa onde você mora é própria, alugada ou cedida?',
                'check' => false,
                'section_id' => 1
            ],
            // seção: acesso a serviços
            [
                'question' => 'A sua casa possui acesso à rede elétrica?',
                'check' => false,
                'section_id' => 2
            ],
            [
                'question' => 'A água da sua casa vem da rede pública?',
                'check' => false,
                'section_id' => 2
            ],
            [
                'question' => 'Existe coleta de lixo regular na sua comunidade?',
                'check' => false,
                'section_id' => 2
            ],
            [
                'question' => 'Há esgoto canalizado ou fossa séptica em sua residência?',
                'check' => false,
                'section_id' => 2
            ],
             // seção: mobilidade e Acessibilidade
            [
                'question' => 'A rua onde você mora permite o acesso de veículos?',
                'check' => false,
                'section_id' => 3
            ],
            [
                'question' => 'Você tem fácil acesso a transporte público próximo da sua casa?',
                'check' => false,
                'section_id' => 3
            ],
            [
                'question' => 'Há calçadas na sua rua?',
                'check' => false,
                'section_id' => 3
            ],
            // seção: Segurança
            [
                'question' => 'Você se sente seguro na sua comunidade durante o dia?',
                'check' => false,
                'section_id' => 4
            ],
            [
                'question' => 'E durante a noite?',
                'check' => false,
                'section_id' => 4
            ],
            [
                'question' => 'Existem postes de luz funcionando em sua rua?',
                'check' => false,
                'section_id' => 4
            ],
            // seção Condições Ambientais
            [
                'question' => 'Sua casa costuma alagar em períodos de chuva?',
                'check' => false,
                'section_id' => 5
            ],
            [
                'question' => 'Há áreas com acúmulo de lixo ou entulho próximas à sua residência?',
                'check' => false,
                'section_id' => 5
            ],
            [
                'question' => 'Há saneamento básico adequado na sua rua?',
                'check' => false,
                'section_id' => 5
            ],
            // seção Convivência na Comunidade
            [
                'question' => 'Há espaços de convivência (praças, áreas de lazer) próximos da sua casa?',
                'check' => false,
                'section_id' => 6
            ],
            [
                'question' => 'Existem organizações comunitárias ou associações de moradores ativas na sua região?',
                'check' => false,
                'section_id' => 6
            ],

        ];

        DB::table('housing_profiles')->insert($questions);
    }
}
