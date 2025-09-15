<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Church;

class MemberSeeder extends Seeder
{
    public function run()
    {
        // Get all churches
        $churches = Church::all();

        foreach ($churches as $church) {
            // Create 2 members per church
            $church->members()->create([
                'name' => 'Member 1 of ' . $church->name,
                'email' => 'member1_' . $church->id . '@example.com',
                'password' => bcrypt('password'),
                'role' => 'member',
            ]);

            $church->members()->create([
                'name' => 'Member 2 of ' . $church->name,
                'email' => 'member2_' . $church->id . '@example.com',
                'password' => bcrypt('password'),
                'role' => 'member',
            ]);
        }
    }
}
