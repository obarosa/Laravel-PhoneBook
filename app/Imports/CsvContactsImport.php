<?php

namespace App\Imports;

use App\Models\CsvContacts;
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

class CsvContactsImport implements ToModel, WithHeadingRow, SkipsEmptyRows, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CsvContacts([
            'username' => $row['username'],
            'pri_nome' => $row['pri_nome'],
            'empresa' => $row['empresa'],
            'email' => $row['email'],
            'nmr_telemovel' => $row['nmr_telemovel'],
            'nmr_escritorio' => $row['nmr_escritorio'],
            'nmr_casa' => $row['nmr_casa'],
            'notas' => $row['notas'],
        ]);
    }
    public function rules(): array
    {
        return [
            '*.email'=>['email', 'unique:contacts,email']
        ];
    }

}
