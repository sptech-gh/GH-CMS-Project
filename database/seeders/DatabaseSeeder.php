<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Church;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create some churches
        $churches = Church::factory(5)->create();

        // Create a test user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Attach this user to a few churches as admin
        $user->churches()->syncWithPivotValues(
            $churches->pluck('id')->take(2),
            ['role' => 'admin']
        );

        // Create a member user
        $member = User::factory()->create([
            'name' => 'Member User',
            'email' => 'member@example.com',
            'password' => bcrypt('password'),
        ]);

        // Attach member to just one church
        $member->churches()->syncWithPivotValues(
            [$churches->first()->id],
            ['role' => 'member']
        );
    }
}
