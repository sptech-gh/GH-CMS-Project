<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        Member::create(['name' => 'John Doe', 'email' => 'john@example.com']);
        Member::create(['name' => 'Jane Smith', 'email' => 'jane@example.com']);
    }
}
