<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            ['gender' => 'Masculino'],
            ['gender' => 'Feminino'],
            ['gender' => 'Não binário'],
            ['gender' => 'Prefiro não informar'],
            ['gender' => 'Outro'],
        ];

        DB::table('genders')->insert($genders);
    }
}
