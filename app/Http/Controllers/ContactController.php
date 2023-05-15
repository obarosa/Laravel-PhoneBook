<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ApiRequest;
use PDF;
use Illuminate\Http\Request;
use App\Imports\ContactsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContactController extends GeralController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $perPage = $request->perPage ?? 15;
        $countContactos = Contact::count();
        // $data = Contact::latest()->paginate($perPage);
        $data = Contact::latest()->get();
        $dados = ApiRequest::all();
        $countConflitos = $this->countConflitos();

        return view('admin_dashboard', compact('data', 'countContactos', 'dados', 'countConflitos'));
    }

    public function indexUtilizador(Request $request)
    {
        // $perPage = $request->perPage ?? 15;
        $countContactos = Contact::count();
        $dados = ApiRequest::all();
        $data = Contact::latest()->get();
        $countConflitos = $this->countConflitos();

        return view('dashboard', compact('data', 'countContactos', 'dados', 'countConflitos'));
    }

    // function searchBar(Request $request)
    // {
    //     $perPage = $request->perPage ?? 15;
    //     $countContactos = Contact::count();
    //     $dados = ApiRequest::all();
    //     $countConflitos = $this->countConflitos();

    //     $search_text = $request->has('query') ? $request->query('query') : null;
    //     if ($search_text == null){
    //         return back();
    //     }
    //     $data = DB::table('contacts')->where('username', 'LIKE', '%' . $search_text . '%')
    //         ->orWhere('pri_nome', 'LIKE', "%{$search_text}%")
    //         ->orWhere('apelido', 'LIKE', "%{$search_text}%")
    //         ->orWhere('email', 'LIKE', "%{$search_text}%")
    //         ->orWhere('empresa', 'LIKE', "%{$search_text}%")
    //         ->orWhere('tipo', 'LIKE', "%{$search_text}%")
    //         ->orWhere('grupo', 'LIKE', "%{$search_text}%")
    //         ->orWhere('nmr_casa', 'LIKE', "%{$search_text}%")
    //         ->orWhere('nmr_telemovel', 'LIKE', "%{$search_text}%")
    //         ->orWhere('nmr_escritorio', 'LIKE', "%{$search_text}%")->paginate();
    //     $data->appends($request->all());

    //     return view('admin_dashboard', compact('data', 'countContactos', 'dados', 'countConflitos'));
    // }

    // function searchBarUtilizador(Request $request)
    // {
    //     $perPage = $request->perPage ?? 15;
    //     $dados = ApiRequest::all();
    //     $countContactos = Contact::count();
    //     $countConflitos = $this->countConflitos();

    //     $search_text = $request->has('queryUtilizador') ? $request->query('queryUtilizador') : null;
    //     $data = DB::table('contacts')->where('username', 'LIKE', '%' . $search_text . '%')
    //         ->orWhere('pri_nome', 'LIKE', "%{$search_text}%")
    //         ->orWhere('apelido', 'LIKE', "%{$search_text}%")
    //         ->orWhere('email', 'LIKE', "%{$search_text}%")
    //         ->orWhere('empresa', 'LIKE', "%{$search_text}%")
    //         ->orWhere('tipo', 'LIKE', "%{$search_text}%")
    //         ->orWhere('grupo', 'LIKE', "%{$search_text}%")
    //         ->orWhere('nmr_casa', 'LIKE', "%{$search_text}%")
    //         ->orWhere('nmr_telemovel', 'LIKE', "%{$search_text}%")
    //         ->orWhere('nmr_escritorio', 'LIKE', "%{$search_text}%")->paginate($perPage);
    //     $data->appends($request->all());

    //     return view('dashboard', compact('data', 'countContactos', 'dados', 'countConflitos', 'perPage'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'firstName' => 'nullable',
            'lastName' => 'nullable',
            'username' => 'required',
            'email' => 'email',
            'empresa' => 'nullable',
            'nmrEscritorio' => 'nullable',
            'nmrTelemovel' => 'nullable',
            'nmrCasa' => 'nullable',
            'tipo' => 'nullable',
            'grupo' => 'nullable',
            'favorito' => 'nullable',
            'notas' => 'nullable',
            'usaNmrTelemovel' => 'nullable',
            'usaNmrTlfEscrt' => 'nullable',
        ]);
        $data = new Contact();
        $data->pri_nome = $request->get('firstName');
        $data->apelido =  $request->get('lastName');
        $data->username =  $request->get('username');
        $data->email =  $request->get('email');
        $data->empresa =  $request->get('empresa');
        $data->nmr_escritorio =  $request->get('nmrEscritorio');
        $data->nmr_telemovel =  $request->get('nmrTelemovel');
        $data->nmr_casa =  $request->get('nmrCasa');
        $data->tipo =  $request->get('tipo');
        $data->grupo =  $request->get('grupo');
        $data->favorito =  $request->get('favorito');
        $data->notas =  $request->get('notas');
        $data->usar_nmr_telemovel = $request->get('usaNmrTelemovel');
        $data->usar_nmr_escritorio = $request->get('usaNmrTlfEscrt');

        $data->save();
        return back()->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $id)
    {
        $countContactos = Contact::count();
        $dados = ApiRequest::all();
        $data = Contact::all();
        $countConflitos = $this->countConflitos();

        return view('admin_dashboard', compact('data', 'countContactos', 'dados', 'countConflitos'));
    }

    // public function showUtilizador(Contact $id)
    // {
    //     $countContactos = Contact::count();
    //     $dados = ApiRequest::all();
    //     $data = Contact::all();
    //     $countConflitos = $this->countConflitos();

    //     return view('dashboard', compact('data', 'countContactos', 'dados', 'countConflitos'));
    // }

    // public function showDetalhes(Request $request, $contacto)
    // {
    //     $countContactos = Contact::count();
    //     $dados = ApiRequest::all();
    //     $data = Contact::find($contacto);
    //     $countConflitos = $this->countConflitos();

    //     return view('admin_dashboard', compact('data', 'contacto', 'countContactos', 'dados', 'countConflitos'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contacto)
    {
        $countContactos = Contact::count();
        $dados = ApiRequest::all();
        $countConflitos = $this->countConflitos();

        return view('admin_dashboard', compact('contacto', 'countContactos', 'dados', 'countConflitos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contacto)
    {

        $data = $request->validate([
            'pri_nome' => 'nullable',
            'apelido' => 'nullable',
            'username' => '',
            'email' => '',
            'empresa' => 'nullable',
            'nmr_escritorio' => 'nullable',
            'nmr_telemovel' => 'nullable',
            'nmr_casa' => 'nullable',
            'tipo' => 'nullable',
            'grupo' => 'nullable',
            'favorito' => 'nullable',
            'notas' => 'nullable',
            'usar_nmr_telemovel' => 'nullable',
            'usar_nmr_escritorio' => 'nullable',
        ]);

        $data = Contact::find($contacto);
        $data->pri_nome = $request->pri_nome;
        $data->apelido =  $request->apelido;
        $data->username =  $request->username;
        $data->email =  $request->email;
        $data->empresa =  $request->empresa;
        $data->nmr_escritorio =  $request->nmr_escritorio;
        $data->nmr_telemovel =  $request->nmr_telemovel;
        $data->nmr_casa =  $request->nmr_casa;
        $data->tipo =  $request->tipo;
        $data->grupo =  $request->grupo;
        $data->favorito =  $request->has('favorito') ? 1 : 0;
        $data->notas =  $request->notas;
        $data->usar_nmr_telemovel = $request->has('usar_nmr_telemovel') ? 1 : 0;;
        $data->usar_nmr_escritorio = $request->has('usar_nmr_escritorio') ? 1 : 0;

        $data->update();
        return back()->with('data', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contacto)
    {
        $contacto->delete();
        return ['url' => route('dashboard.index')];
    }

    // IMPORT EXCEL (csv está noutro controlador)
    public function importContactsExcel()
    {
        $dados = ApiRequest::all();
        return view('contacts.import_excel')->with('dados', $dados);
    }
    public function importExcel(Request $request)
    {
        $dados = ApiRequest::all();

        $file = $request->file('fileExportExcel');
        if ($request->file('fileExportExcel') == null) {
            return back()->withErro('Selecione um Ficheiro');
        }
        $import = new ContactsImport;
        $import->import($file);
        // dd($import->failures());
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }

        return back()->withStatus('Contactos Importados!')->with('dados', $dados);
    }

    // EXPORT SHOW
    public function exportYealinkXml()
    {
        $contacts = Contact::all();
        return response()->view('xml_export.yealink_xml', [
            'contacts' => $contacts
        ])->header('Content-Type', 'text/xml');
    }
    public function exportMicrosipXml()
    {
        $contacts = Contact::all();
        return response()->view('xml_export.microsip_xml', [
            'contacts' => $contacts
        ])->header('Content-Type', 'text/xml');
    }
    public function exportGrandstreamXml()
    {
        $contacts = Contact::all();
        return response()->view('xml_export.grandstream_xml', [
            'contacts' => $contacts
        ])->header('Content-Type', 'text/xml');
    }
    public function exportGigasetXml()
    {
        $contacts = Contact::all();
        return response()->view('xml_export.gigaset_xml', [
            'contacts' => $contacts
        ])->header('Content-Type', 'text/xml');
    }

    // EXPORT XML DOWNLOAD
    public function downloadYealinkXml()
    {
        $diretorio = DB::table('export_definicions')->where('id', 1)->value('yealink_directory');
        $nomeFicheiro = DB::table('export_definicions')->where('id', 1)->value('yealink_name');
        $contacts = Contact::all();
        $disk = Storage::build([
            'driver' => 'local',
            'root' => $diretorio,
        ]);

        $yau = view('xml_export.yealink_xml', ['contacts' => $contacts]);
        $disk->put($nomeFicheiro . '_' . now()->day . '-' . now()->month . '-' . now()->year . '_' . now()->milli . '.xml', $yau);

        return back()->withStatus('Ficheiro guardado no diretório -> ' . $diretorio . '. Pode alterar o nome e o diretório nas Definições->Exportação!');
    }
    public function downloadMicrosipXml()
    {
        $diretorio = DB::table('export_definicions')->where('id', 1)->value('microsip_directory');
        $nomeFicheiro = DB::table('export_definicions')->where('id', 1)->value('microsip_name');
        $contacts = Contact::all();
        $disk = Storage::build([
            'driver' => 'local',
            'root' => $diretorio,
        ]);

        $yau = view('xml_export.microsip_xml', ['contacts' => $contacts]);
        $disk->put($nomeFicheiro . '_' . now()->day . '-' . now()->month . '-' . now()->year . '_' . now()->milli . '.xml', $yau);

        return back()->withStatus('Ficheiro guardado no diretório -> ' . $diretorio . '. Pode alterar o nome e o diretório nas Definições->Exportação!');
    }
    public function downloadGrandstreamXml()
    {
        $diretorio = DB::table('export_definicions')->where('id', 1)->value('grandstream_directory');
        $nomeFicheiro = DB::table('export_definicions')->where('id', 1)->value('grandstream_name');
        $contacts = Contact::all();
        $disk = Storage::build([
            'driver' => 'local',
            'root' => $diretorio,
        ]);

        $yau = view('xml_export.grandstream_xml', ['contacts' => $contacts]);
        $disk->put($nomeFicheiro . '_' . now()->day . '-' . now()->month . '-' . now()->year . '_' . now()->milli . '.xml', $yau);

        return back()->withStatus('Ficheiro guardado no diretório -> ' . $diretorio . '. Pode alterar o nome e o diretório nas Definições->Exportação!');
    }
    public function downloadGigasetXml()
    {
        $diretorio = DB::table('export_definicions')->where('id', 1)->value('gigaset_directory');
        $nomeFicheiro = DB::table('export_definicions')->where('id', 1)->value('gigaset_name');
        $contacts = Contact::all();
        $disk = Storage::build([
            'driver' => 'local',
            'root' => $diretorio,
        ]);

        $yau = view('xml_export.gigaset_xml', ['contacts' => $contacts]);
        $disk->put($nomeFicheiro . '_' . now()->day . '-' . now()->month . '-' . now()->year . '_' . now()->milli . '.xml', $yau);

        return back()->withStatus('Ficheiro guardado no diretório -> ' . $diretorio . '. Pode alterar o nome e o diretório nas Definições->Exportação!');
    }
    // EXPORT PDF DOWNLOAD
    // public function downloadPdf()
    // {
    //     $contacts = Contact::all();
    //     $pdf = PDF::loadView('pdf_export.phonebook_pdf', ['contacts' => $contacts]);
    //     return $pdf->download('phonebook.pdf');
    // }
}
