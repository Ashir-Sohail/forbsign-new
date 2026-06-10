<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Admin::factory()->create(
            [
                'email' => 'admin@gmail.com',
                'username' => 'Admin User',
                'password' => Hash::make('Admin@123'),
            ]
        );

        $this->call([
            ManageSitesTableSeeder::class,
            PagesTableSeeder::class,

        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
