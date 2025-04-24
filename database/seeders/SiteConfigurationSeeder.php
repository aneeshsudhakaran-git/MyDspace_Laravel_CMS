<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiteConfigurationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('site_configurations')->insert([
            [
                'id' => 1,
                'config_title' => 'Site Name',
                'config_name' => 'Site_Name',
                'config_value' => 'MyDspace CMS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'config_title' => 'Site URL',
                'config_name' => 'Site_URL',
                'config_value' => 'https://mydspace.in',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'config_title' => 'Site_Meta',
                'config_name' => 'Site_Meta',
                'config_value' => '<meta name="author" content="mydspace.in">',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'config_title' => 'Site Meta Description',
                'config_name' => 'Site_Meta_Description',
                'config_value' => 'Site Meta Description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'config_title' => 'Site Meta Keywords',
                'config_name' => 'Site_Meta_Keywords',
                'config_value' => 'Site Meta Keywords',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'config_title' => 'Site Menu Style Name',
                'config_name' => 'Site_Menu_Style_Name',
                'config_value' => json_encode([
                    "1" => "btn-getstarted",
                    "2" => "dropdown",
                    "3" => "btn btn-primary rounded-pill",
                    "4" => "btn btn-secondary rounded-pill",
                    "5" => "btn btn-success rounded-pill",
                    "6" => "btn btn-warning rounded-pill",
                    "7" => "btn btn-info rounded-pill",
                    "8" => "btn btn-dark rounded-pill",
                    "9" => "btn btn-light rounded-pill"
                ], JSON_PRETTY_PRINT),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'config_title' => 'Site Content Style Name',
                'config_name' => 'Site_Content_Style_Name',
                'config_value' => json_encode([
                    "1" => "hero",
                    "2" => "featured-services",
                    "3" => "about",
                    "4" => "stats",
                    "5" => "services light-background",
                    "6" => "portfolio",
                    "7" => "testimonials",
                    "8" => "call-to-action accent-background",
                    "9" => "team",
                    "10" => "contact",
                    "11" => "starter-section",
                    "12" => "footer-newsletter",
                    "13" => "container footer-top",
                    "14" => "copyright",
                    "15" => "container ",
                    "16" => "light-background"
                ], JSON_PRETTY_PRINT),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'config_title' => 'Site Custom Style',
                'config_name' => 'Site_Custom_Style',
                'config_value' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'config_title' => 'Site Custom Scripts',
                'config_name' => 'Site_Custom_Scripts',
                'config_value' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
