<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'hlgest',
        'usar_hlgest',
        'primavera',
        'usar_primavera',
        'phc',
        'usar_phc',
        'atualizacao'
    ];
}
