<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Schedule::create([
            'enabled_days' => json_encode([1, 2, 3, 4, 5]),
            'min_time' => '08:00:00',
            'max_time' => '17:00:00',
            'max' => 7,
            'min' => 3,
        ]);
    }
}
