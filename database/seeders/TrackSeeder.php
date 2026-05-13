<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tracks')->insert([
            [
                'code' => 'H1',
                'name' => 'CCP-ISP',
                'distance' => 10.5,
                'description' => 'Rute zona 1 dari CCP ke ISP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'H2',
                'name' => 'ISP-PORT',
                'distance' => 15.0,
                'description' => 'Rute zona 2 dari ISP ke PORT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'H0',
                'name' => 'CCP-PORT',
                'distance' => 25.0,
                'description' => 'Rute zona long trip dari CCP ke PORT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
