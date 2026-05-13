<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periods')->insert([
            [
                'name' => 'Periode I',
                'month' => 1,
                'year' => 2026,
                'is_active' => 0,
                'description' => 'Periode I bulan Januari 2026 (01-07 Januari 2026)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Periode II',
                'month' => 1,
                'year' => 2026,
                'is_active' => 1,
                'description' => 'Periode II bulan Januari 2026 (08-14 Januari 2026)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
