<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'cpf' => '1234',
                'first_name' => 'Admin 1',
                'surname' => 'da silva',
                'email' => 'admin1@email.com',
                'mobile_number' => '82999654909',
                'password' => Hash::make('123'),
                'community_id' => 1,
                'active' => true,
                'profile_picture' => "img/admin-placeholder.png"
            ],
        ];
        
        DB::table('admin')->insert($admins);
    }
}
