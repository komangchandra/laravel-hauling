<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('owners')->insert([
            [
                'name' => 'Gorby Putra Utama',
                'short_name' => 'GPU',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gorby Energy',
                'short_name' => 'GE',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
