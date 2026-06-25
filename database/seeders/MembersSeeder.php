<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MembersSeeder extends Seeder
{
    public function run(): void
    {
        Member::create([
            'name' => '山田 太郎',
            'membership_code' => 'LIB-0001',
            'registered_at' => now()->subYear(),
        ]);

        Member::create([
            'name' => '佐藤 花子',
            'membership_code' => 'LIB-0002',
            'registered_at' => now()->subMonths(6),
        ]);
    }
}

