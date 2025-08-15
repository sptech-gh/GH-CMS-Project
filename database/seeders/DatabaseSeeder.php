<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Church;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create example churches
        $this->call(\Database\Seeders\ChurchSeeder::class);
    }
}
