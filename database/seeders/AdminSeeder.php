<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Admin',
            'email' => 'admin@mydspace.in',
            'email_verified_at' => now(),
            'password' => Hash::make('mydspace2025'),
            'usertype' => 'W',
            'image' => '', // You can add a default image path here if needed
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
