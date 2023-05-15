<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvContacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'pri_nome',
        'email',
        'empresa',
        'nmr_escritorio',
        'nmr_telemovel',
        'nmr_casa',
        'notas',
    ];
}
