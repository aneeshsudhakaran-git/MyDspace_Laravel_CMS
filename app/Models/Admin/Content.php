<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, longText>
     */
    protected $fillable = [
        'title',
        'category',
        'menu',
        'short_description',
        'description',
        'displayorder',
        'featured',
        'image',
        'download_file_title',
        'download_file',
        'classname',
        'content_section',
        'status',
    ];
}
