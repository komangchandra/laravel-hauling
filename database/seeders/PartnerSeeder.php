<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partner::insert([
            [
                'legal_name' => 'Gorby Putra Utama',
                'short_name' => 'GPU',
                'email' => 'gpu@gorby.co.id',
                'phone' => null,
                'address' => null,
                'tax_identity_number' => null,
                'status' => 'active',
                'owner_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'legal_name' => 'Gorby Energy',
                'short_name' => 'GE',
                'email' => 'ge@gorby.co.id',
                'phone' => null,
                'address' => null,
                'tax_identity_number' => null,
                'status' => 'active',
                'owner_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'legal_name' => 'Karimata Multi Prima',
                'short_name' => 'KMP',
                'email' => 'kmp@karimata.co.id',
                'phone' => null,
                'address' => null,
                'tax_identity_number' => null,
                'status' => 'active',
                'owner_id' => 1, // bebas pilih owner
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
