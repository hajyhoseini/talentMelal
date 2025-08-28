<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectColor extends Model
{
    protected $table = 'project_colors';

    protected $fillable = [
        'color_name',
        'color_hex',
    ];

    // اگر لازم بود timestamp ها رو غیر فعال کنی:
    // public $timestamps = false;
}
