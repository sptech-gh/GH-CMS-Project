<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Church;

class ChurchSeeder extends Seeder
{
    public function run(): void
    {
        Church::create(['name' => 'Grace Chapel', 'location' => 'Accra', 'region' => 'Greater Accra']);
        Church::create(['name' => 'Faith Center', 'location' => 'Kumasi', 'region' => 'Ashanti']);
    }
}
