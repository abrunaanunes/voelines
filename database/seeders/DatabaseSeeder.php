<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Voelines',
                'email' => 'contato@voelines.com.br',
                'password' => '$2y$10$H/QkdnCY30CaUZxEAMkBiet4I1wwrbJN1/dK6U7d9Eszeq1C1KFmS', // M4tr1x123
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ]
        ]);
    }
}
