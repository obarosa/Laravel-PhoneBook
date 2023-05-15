<?php

namespace App\Http\Controllers;

use SimpleXMLElement;
use GuzzleHttp\Client;
use App\Models\Contact;
use App\Models\ApiRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dados = ApiRequest::all();
        return view('admin_dashboard', compact('dados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'hlGestURLinput' => '',
            'primaveraURLinput' => '',
            'phcURLinput' => '',
            'hlGestURLcheckbox' => '',
            'primaveraURLcheckbox' => '',
            'phcURLcheckbox' => '',
            'freqAtualizacoesSelect' => '',
        ]);

        $dados = ApiRequest::updateOrCreate(
            [
                'id' =>  1
            ],
            [
                'hlgest' =>  request('hlGestURLinput'),
                'primavera' => request('primaveraURLinput'),
                'phc' => request('phcURLinput'),
                'usar_hlgest' => request('hlGestURLcheckbox'),
                'usar_primavera' => request('primaveraURLcheckbox'),
                'usar_phc' => request('phcURLcheckbox'),
                'atualizacao' => request('freqAtualizacoesSelect'),
            ]
        );

        return back()->with('dados', $dados);
    }
    public function getFakeContacts()
    {
        return simplexml_load_file(base_path('dados/contacts.xml'));
    }
    public function hlgestApi(Request $request)
    {
        $linkHlgest = $request->get('hlgestLink');
        $client = new \SoapClient($linkHlgest);

        $funcoes = $client->ListaTelefonica();
        $arr = ((array)$funcoes->ListaTelefonicaResult);
        $arr["any"] = str_replace("&nbsp;", " ", $arr["any"]);
        $listFuncoes = new SimpleXMLElement($arr["any"]);

        $xmlAtribute = $listFuncoes;

        $dados = Contact::all();
        foreach ($xmlAtribute as $contact) {
            if ($contact->DisplayName == '') {
                $yau = $dados->username = $contact->Nome;
            } else {
                $yau = $dados->username = $contact->DisplayName;
            }
            $nome = $contact->Nome;
            $nomeC = explode(" ", $nome);
            Contact::firstOrCreate([
                'username' => $yau,
                'pri_nome' => $nomeC[0],
                'apelido' => !empty($nomeC[1]) ? $nomeC[1] : '',
                'email' => $contact->Email,
                'empresa' =>  $contact->Empresa,
                'nmr_escritorio' =>  $contact->Telefone,
                'nmr_telemovel' =>  $contact->Telemovel,
                'notas' => $contact->Notes,
            ]);
        }
    }
    public function primaveraApi()
    {
        // dd($this->getFakeContacts());
        $xml = $this->getFakeContacts();

        $xmlAtribute = $xml->record;

        for ($i = 0; $i < count($xmlAtribute); $i++) {
            $dados = new Contact();
            $dados->pri_nome = $xmlAtribute[$i]->pri_nome;
            $dados->apelido =  $xmlAtribute[$i]->apelido;
            $dados->username =  $xmlAtribute[$i]->name;
            $dados->email = $xmlAtribute[$i]->email;
            $dados->empresa =  $xmlAtribute[$i]->empresa;
            $dados->nmr_escritorio =  $xmlAtribute[$i]->phone;
            $dados->nmr_telemovel =  $xmlAtribute[$i]->nmr_telemovel;
            $dados->nmr_casa =  $xmlAtribute[$i]->nmr_casa;
            $dados->tipo =  $xmlAtribute[$i]->tipo;
            $dados->grupo =  $xmlAtribute[$i]->grupo;
            $dados->favorito =  $xmlAtribute[$i]->favorito ? 1 : 0;
            $dados->notas =  $xmlAtribute[$i]->notas;
            $dados->usar_nmr_telemovel = $xmlAtribute[$i]->usar_nmr_telemovel ? 1 : 0;;
            $dados->usar_nmr_escritorio = $xmlAtribute[$i]->usar_nmr_escritorio ? 1 : 0;
            $result = $dados->save();
            // var_dump($xmlAtribute[$i]);

        }
        if ($result) {
            return ["Resultado" => "Dados Guardados"];
        } else {
            ["Resultado" => "ERRO"];
        }
    }
    public function phcApi()
    {
        // dd($this->getFakeContacts());
        $xml = $this->getFakeContacts();

        $xmlAtribute = $xml->record;

        for ($i = 0; $i < count($xmlAtribute); $i++) {
            $dados = new Contact();
            $dados->pri_nome = $xmlAtribute[$i]->pri_nome;
            $dados->apelido =  $xmlAtribute[$i]->apelido;
            $dados->username =  $xmlAtribute[$i]->name;
            $dados->email = $xmlAtribute[$i]->email;
            $dados->empresa =  $xmlAtribute[$i]->empresa;
            $dados->nmr_escritorio =  $xmlAtribute[$i]->phone;
            $dados->nmr_telemovel =  $xmlAtribute[$i]->nmr_telemovel;
            $dados->nmr_casa =  $xmlAtribute[$i]->nmr_casa;
            $dados->tipo =  $xmlAtribute[$i]->tipo;
            $dados->grupo =  $xmlAtribute[$i]->grupo;
            $dados->favorito =  $xmlAtribute[$i]->favorito ? 1 : 0;
            $dados->notas =  $xmlAtribute[$i]->notas;
            $dados->usar_nmr_telemovel = $xmlAtribute[$i]->usar_nmr_telemovel ? 1 : 0;;
            $dados->usar_nmr_escritorio = $xmlAtribute[$i]->usar_nmr_escritorio ? 1 : 0;
            $result = $dados->save();
            // var_dump($xmlAtribute[$i]);

        }
        if ($result) {
            return ["Resultado" => "Dados Guardados"];
        } else {
            ["Resultado" => "ERRO"];
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $dados = ApiRequest::all();
        return $dados;
    }

}
