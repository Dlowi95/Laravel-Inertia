<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'loisadnhan@gmail.com'],
            [
                'name' => 'Vo Hoang Dai Loi',
                'password' => '123456',
                'email_verified_at' => now(),
            ]
        );
    }
}
