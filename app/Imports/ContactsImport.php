<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ContactsImport implements ToModel, WithHeadingRow, SkipsEmptyRows, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Contact([
            "username" => $row['username'],
            "email" => $row['email'],
            "nmr_escritorio" => $row['nmr_escritorio'],
            "nmr_telemovel" => $row['nmr_telemovel'],
            "nmr_casa" => $row['nmr_casa'],
            "pri_nome" => $row['nome'],
            "empresa" => $row['empresa'],
            "notas" => $row['notas'],
        ]);
    }

    public function rules(): array
    {
        return [
            '*.email'=>['email', 'unique:contacts,email']
        ];
    }
}
