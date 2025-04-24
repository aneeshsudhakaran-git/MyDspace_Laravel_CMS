<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteConfiguration extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'config_title',
        'config_name',
        'config_value',
    ];

    public static function getMenuStyleName() {
        $configval =  SiteConfiguration::where('config_name', 'Site_Menu_Style_Name')->first();
        $Site_Menu_Style_Name = json_decode(trim($configval->config_value), true);
        return $Site_Menu_Style_Name;
    }

    public static function getContentStyleName() {
        $configval =  SiteConfiguration::where('config_name', 'Site_Content_Style_Name')->first();
        $Site_Content_Style_Name = json_decode(trim($configval->config_value), true);
        return $Site_Content_Style_Name;
    }
}
