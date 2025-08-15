<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Church;

class ChurchSeeder extends Seeder
{
    public function run(): void
    {
        // Minimal, readable records for testing
        $data = [
            ['name' => 'Accra Central Chapel', 'email' => 'info@accrachapel.org', 'website' => 'https://accrachapel.org', 'phone' => '+233201234567', 'address' => 'Accra', 'founded_year' => 1998],
            ['name' => 'Kumasi Faith Temple', 'email' => 'hello@faithtemplegh.com', 'website' => 'https://faithtemplegh.com', 'phone' => '+233241112223', 'address' => 'Kumasi', 'founded_year' => 2005],
            ['name' => 'Takoradi Grace Assembly', 'email' => 'office@graceassembly.org', 'website' => null, 'phone' => '+233552223334', 'address' => 'Takoradi', 'founded_year' => 2010],
        ];

        foreach ($data as $row) {
            Church::create($row); // slug auto-generated
        }
    }
}
