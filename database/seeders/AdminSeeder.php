<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@happypaws.com',
            'password' => bcrypt('admin123'),
        ]);

        Admin::factory(2)->create();
    }
}
