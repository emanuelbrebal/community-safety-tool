<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $communities = [
            [
                'community' => "Vale do Reginaldo",
                'active' => true
            ],
            [
                'community' => "Grota do Cigano",
                'active' => true
            ],
            [
                'community' => "Grota da Alegria B",
                'active' => true
            ],
            [
                'community' => "Vila Brejal",
                'active' => true
            ],
            [
                'community' => "Área Vulnerabilizada do Vergel",
                'active' => true
            ],
            [
                'community' => "Conjunto Paraíso do Horto",
                'active' => true
            ],
            [
                'community' => "Grota do Moreira",
                'active' => true
            ],
            [
                'community' => "Chã de Bebedouro A",
                'active' => true
            ],
            [
                'community' => "Alto São Rafael",
                'active' => true
            ],
            [
                'community' => "Grota do Rafael",
                'active' => true
            ]
        ];

        DB::table('communities')->insert($communities);
    }
}
