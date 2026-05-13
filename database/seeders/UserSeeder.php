<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Partner;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // roles
        $developerRole = Role::firstOrCreate(['name' => 'Developer']);
        $ownerRole = Role::firstOrCreate(['name' => 'Owner']);
        $mitraRole = Role::firstOrCreate(['name' => 'Mitra']);

        

        // ======================
        // Dewveloper
        // ======================
        $developer = User::firstOrCreate(
            ['email' => 'komangchandraaa1@gmail.com'],
            [
                'name' => 'Komang Chandra Winata',
                'password' => Hash::make('Empire8855!'),
                'partner_id' => null,
            ]
        );
        $developer->assignRole($developerRole);

        // ======================
        // OWNER
        // ======================
        $owner = User::firstOrCreate(
            ['email' => 'adminhauling@gorbyputrautama.com'],
            [
                'name' => 'Admin Hauling',
                'password' => Hash::make('@Kemang43'),
                'partner_id' => null,
            ]
        );
        $owner->assignRole($ownerRole);

        // ======================
        // MITRA (Admin KMP)
        // ======================
        $mitra = User::firstOrCreate(
            ['email' => 'database.engineering@karimatamultiprima.com'],
            [
                'name' => 'Admin KMP',
                'password' => Hash::make('password'),
            ]
        );
        $mitra->assignRole($mitraRole);

        // ======================
        // LINK KE PARTNER (KMP)
        // ======================
        $partner = Partner::where('short_name', 'KMP')->first();

        if ($partner) {
            $mitra->update([
                'partner_id' => $partner->id
            ]);
        }
    }
}
