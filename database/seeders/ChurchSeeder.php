<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Church;

class ChurchSeeder extends Seeder
{
    public function run(): void
    {
        $churches = [
            [
                'name'        => 'Grace Chapel',
                'location'    => 'Accra',
                'region'      => 'Greater Accra',
                'denomination'=> 'Non-Denominational',
                'founded_at'  => '1995-06-12',
                'description' => 'A vibrant church focused on worship and discipleship.',
            ],
            [
                'name'        => 'Hope Ministries',
                'location'    => 'Kumasi',
                'region'      => 'Ashanti',
                'denomination'=> 'Pentecostal',
                'founded_at'  => '2001-03-15',
                'description' => 'A growing church with community outreach programs.',
            ],
            [
                'name'        => 'Faith International',
                'location'    => 'Takoradi',
                'region'      => 'Western',
                'denomination'=> 'Charismatic',
                'founded_at'  => '2010-07-10',
                'description' => 'A church dedicated to youth and community development.',
            ],
            [
                'name'        => 'Anidaso Chapel',
                'location'    => 'Accra',
                'region'      => 'Greater Accra',
                'denomination'=> 'Evangelical',
                'founded_at'  => '1995-03-12',
                'description' => 'A vibrant Christian community focused on faith, hope, and love.',
            ],
        ];

        foreach ($churches as $churchData) {
            Church::updateOrCreate(
                ['name' => $churchData['name']], // match by name
                $churchData
            );
        }
    }
}
