<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $users = [
            [
                'cpf' => '123',
                'first_name' => 'Usuario 1',
                'surname' => 'Sobrenome',
                'gender_id' => 1,
                'email' => 'user1@email.com',
                'mobile_number' => '82999654909',
                'born_date' => '2013-01-12',
                'password' => Hash::make('123'),
                'active' => true
            ],
        ];

        
        DB::table('users')->insert($users);
    }
}
