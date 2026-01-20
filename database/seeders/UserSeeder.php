<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::firstOrCreate(
            ['email' => 'superAdmin@example.com'],
            [
            'name' => 'Super Admin',
            'password' => bcrypt('secretAdmin'),
            'role' => 'superAdmin'
        ]);

        User::factory(10)->create();

        User::factory()->admin()->count(2)->create();
    }
}
