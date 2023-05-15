<?php

namespace App\Http\Controllers;

use App\Models\CsvContacts;
use Illuminate\Http\Request;
use App\Imports\CsvContactsImport;
use App\Models\Contact;

class CsvContactController extends Controller
{
    public function importContactsCsv()
    {
        $csvContacts = CsvContacts::all();
        return view('contacts.import_csv', compact('csvContacts'));
    }

    public function show(CsvContacts $csvContacts)
    {
        return view('contacts.import_csv', compact('csvContacts'));
    }

    public function importCsv(Request $request)
    {
        $file = $request->file('fileExportCsv');
        if($request->file('fileExportCsv') == null){
            return back()->withErro('Selecione um Ficheiro');
        }
        $import = new CsvContactsImport;
        $import->import($file);
        // dd($import->failures());
        if($import->failures()->isNotEmpty()){
            return back()->withFailures($import->failures());
        }

        return back()->withStatus('Ficheiro Carregado!');
    }

    public function transferData()
    {
        CsvContacts::query()->orderBy('id')->chunk('1000', function ($rows) {
            foreach ($rows as $row) {
                //create() expects array
                Contact::create($row->toArray());
                CsvContacts::destroy($row->toArray());
            }
        });

        return back()->withStatus('Contactos Importados!');
    }

    public function destroy(CsvContacts $csv_contacto)
    {
        $csv_contacto->delete();
    }
}
