<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'id' => 1,
                'name' => 'home',
                'title' => 'Home',
                'classname' => 0,
                'parent_id' => 0,
                'description' => 'The homepage of the website.',
                'menutype' => 1,
                'displayorder' => 1,
                'status' => 'P',
                'link_type' => 'S',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'about',
                'title' => 'About Us',
                'classname' => 0,
                'parent_id' => 0,
                'description' => 'Learn more about our company.',
                'menutype' => 1,
                'displayorder' => 2,
                'status' => 'P',
                'link_type' => 'S',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'services',
                'title' => 'Our Services',
                'classname' => 3,
                'parent_id' => 0,
                'description' => 'Explore the services we offer.',
                'menutype' => 1,
                'displayorder' => 3,
                'status' => 'P',
                'link_type' => 'S',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'contact',
                'title' => 'Contact Us',
                'classname' => 4,
                'parent_id' => 0,
                'description' => 'Reach out to us via this page.',
                'menutype' => 1,
                'displayorder' => 4,
                'status' => 'P',
                'link_type' => 'S',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'footernav',
                'title' => 'Footer Nav',
                'classname' => 0,
                'parent_id' => 0,
                'description' => '',
                'menutype' => 2,
                'displayorder' => 4,
                'status' => 'P',
                'link_type' => 'S',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'footercopyright',
                'title' => 'Footer copyright',
                'classname' => 0,
                'parent_id' => 0,
                'description' => '',
                'menutype' => 2,
                'displayorder' => 5,
                'status' => 'P',
                'link_type' => 'S',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
