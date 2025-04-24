<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category' => 'Main Content',
                'description' => 'This is the main content category',
                'displayorder' => 1,
                'status' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Footer Content',
                'description' => 'This is the footer content category',
                'displayorder' => 2,
                'status' => 'P',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
