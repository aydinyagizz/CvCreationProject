<?php

namespace Database\Seeders;

use App\Models\Integration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntegrationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Integration::create([
            'name' => 'Google Recaptcha',
            'status' => 1,
            'config' => json_encode([
                'version' => 'v2',
                'secret_key' => '6Ld7uq8eAAAAAGnH9WU69c6TLTA5g29u4GUFS935',
                'site_key' => '6Ld7uq8eAAAAAC2WFz_7IDeayttlazviQxfzmOgU',
                'min_score' => '0.3'
            ])
        ]);
    }
}
