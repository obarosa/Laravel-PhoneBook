<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportDefinicion extends Model
{
    use HasFactory;

    protected $fillable = [
        'yealink_name',
        'yealink_directory',
        'microsip_name',
        'microsip_directory',
        'grandstream_name',
        'grandstream_directory',
        'gigaset_name',
        'gigaset_directory',
    ];
}
