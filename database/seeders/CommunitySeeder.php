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
        DB::table('community')->insert(
            [
                'community' => "Vale do Reginaldo",
            ],
            [
                'community' => "Grota do Cigano",
            ],
            [
                'community' => "Grota da Alegria B",
            ],
            [
                'community' => "Brejal",
            ],
            [
                'community' => "Área Vulnerabilizada do Vergel",
            ],
            [
                'community' => "Conjunto Paraíso do Horto",
            ],
            [
                'community' => "Grota do Moreira",
            ],
            [
                'community' => "Chã de Bebedouro A",
            ],
            [
                'community' => "Alto São Rafael",
            ],
            [
                'community' => "Grota do Rafael",
            ],
        );
    }
}
