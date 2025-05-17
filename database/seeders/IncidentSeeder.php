<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $incidents = [
            [

                'incident' => 'Assalto',
                'description' => 'Ato de roubo à mão armada ou mediante ameaça.'
            ],
            [

                'incident' => 'Furto',
                'description' => 'Subtração de bens sem o uso de violência ou ameaça.'
            ],
            [

                'incident' => 'Vandalismo',
                'description' => 'Dano proposital ao patrimônio público ou privado.'
            ],
            [

                'incident' => 'Tráfico de drogas',
                'description' => 'Atividade ilegal relacionada à venda de entorpecentes.'
            ],
            [

                'incident' => 'Uso de drogas',
                'description' => 'Consumo de substâncias ilícitas em locais públicos.'
            ],
            [

                'incident' => 'Violência doméstica',
                'description' => 'Agressão física, psicológica ou moral no ambiente familiar.'
            ],
            [

                'incident' => 'Agressão física',
                'description' => 'Briga ou ataque que resultou em ferimentos.'
            ],
            [

                'incident' => 'Violência verbal',
                'description' => 'Ameaças, insultos ou intimidação.'
            ],
            [

                'incident' => 'Pessoa desaparecida',
                'description' => 'Relato de indivíduo que está sumido.'
            ],
            [

                'incident' => 'Perturbação do sossego',
                'description' => 'Barulho excessivo, festas, som alto etc.'
            ],
            [

                'incident' => 'Atividade suspeita',
                'description' => 'Movimentação ou comportamento suspeito na área.'
            ],
            [

                'incident' => 'Invasão de propriedade',
                'description' => 'Entrada não autorizada em domicílios ou terrenos.'
            ],
            [

                'incident' => 'Acidente de trânsito',
                'description' => 'Colisão ou atropelamento nas vias locais.'
            ],
            [

                'incident' => 'Incêndio',
                'description' => 'Fogo acidental ou criminoso em residências, terrenos ou estabelecimentos.'
            ],
            [

                'incident' => 'Alagamento',
                'description' => 'Inundação causada por chuvas fortes.'
            ],
            [

                'incident' => 'Falta de iluminação pública',
                'description' => 'Postes ou áreas sem iluminação durante a noite.'
            ],
            [

                'incident' => 'Depredação de escolas ou postos de saúde',
                'description' => 'Ataques ou danos a prédios públicos.'
            ],
            [

                'incident' => 'Explosões ou tiros ouvidos',
                'description' => 'Relato de sons semelhantes a tiros ou explosões.'
            ],
            [

                'incident' => 'Presença de animais perigosos',
                'description' => 'Animais soltos que podem oferecer risco, como cães agressivos ou cobras.'
            ],
            [

                'incident' => 'Problemas com transporte público',
                'description' => 'Ônibus não passam, atrasos constantes, insegurança etc.'
            ],


        ];

        DB::table('incident_type')->insert($incidents);
    }
}
