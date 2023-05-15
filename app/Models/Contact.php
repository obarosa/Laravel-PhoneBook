<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'pri_nome',
        'apelido',
        'username',
        'email',
        'empresa',
        'nmr_escritorio',
        'nmr_telemovel',
        'nmr_casa',
        'tipo',
        'grupo',
        'favorito',
        'notas',
        'usar_nmr_telemovel',
        'usar_nmr_escritorio',
    ];

}
