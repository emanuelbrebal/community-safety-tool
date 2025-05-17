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
                'description' => 'Ato de roubo à mão armada ou mediante ameaça.',
                'urgency_id' => 4
            ],
            [
                'incident' => 'Furto',
                'description' => 'Subtração de bens sem o uso de violência ou ameaça.',
                'urgency_id' => 2
            ],
            [
                'incident' => 'Vandalismo',
                'description' => 'Dano proposital ao patrimônio público ou privado.',
                'urgency_id' => 2
            ],
            [
                'incident' => 'Tráfico de drogas',
                'description' => 'Atividade ilegal relacionada à venda de entorpecentes.',
                'urgency_id' => 3
            ],
            [
                'incident' => 'Uso de drogas',
                'description' => 'Consumo de substâncias ilícitas em locais públicos.',
                'urgency_id' => 2
            ],
            [
                'incident' => 'Violência doméstica',
                'description' => 'Agressão física, psicológica ou moral no ambiente familiar.',
                'urgency_id' => 4
            ],
            [
                'incident' => 'Agressão física',
                'description' => 'Briga ou ataque que resultou em ferimentos.',
                'urgency_id' => 3
            ],
            [
                'incident' => 'Violência verbal',
                'description' => 'Ameaças, insultos ou intimidação.',
                'urgency_id' => 2
            ],
            [
                'incident' => 'Pessoa desaparecida',
                'description' => 'Relato de indivíduo que está sumido.',
                'urgency_id' => 3
            ],
            [
                'incident' => 'Perturbação do sossego',
                'description' => 'Barulho excessivo, festas, som alto etc.',
                'urgency_id' => 1
            ],
            [
                'incident' => 'Atividade suspeita',
                'description' => 'Movimentação ou comportamento suspeito na área.',
                'urgency_id' => 2
            ],
            [
                'incident' => 'Invasão de propriedade',
                'description' => 'Entrada não autorizada em domicílios ou terrenos.',
                'urgency_id' => 3
            ],
            [
                'incident' => 'Acidente de trânsito',
                'description' => 'Colisão ou atropelamento nas vias locais.',
                'urgency_id' => 3
            ],
            [
                'incident' => 'Incêndio',
                'description' => 'Fogo acidental ou criminoso em residências, terrenos ou estabelecimentos.',
                'urgency_id' => 4
            ],
            [
                'incident' => 'Alagamento',
                'description' => 'Inundação causada por chuvas fortes.',
                'urgency_id' => 3
            ],
            [
                'incident' => 'Falta de iluminação pública',
                'description' => 'Postes ou áreas sem iluminação durante a noite.',
                'urgency_id' => 1
            ],
            [
                'incident' => 'Depredação de escolas ou postos de saúde',
                'description' => 'Ataques ou danos a prédios públicos.',
                'urgency_id' => 2
            ],
            [
                'incident' => 'Explosões ou tiros ouvidos',
                'description' => 'Relato de sons semelhantes a tiros ou explosões.',
                'urgency_id' => 4
            ],
            [
                'incident' => 'Presença de animais perigosos',
                'description' => 'Animais soltos que podem oferecer risco, como cães agressivos ou cobras.',
                'urgency_id' => 3
            ],
            [
                'incident' => 'Problemas com transporte público',
                'description' => 'Ônibus não passam, atrasos constantes, insegurança etc.',
                'urgency_id' => 1
            ],
        ];


        DB::table('incident_type')->insert($incidents);
    }
}
