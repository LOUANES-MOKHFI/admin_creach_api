<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Admin::factory()->create([
            'name' => 'louanes mokhfi',
            'email' => 'louanes.mokhfi@gmail.com',
            'password' => bcrypt(123456789)
        ]);
    }
}
