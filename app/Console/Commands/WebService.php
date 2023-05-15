<?php

namespace App\Console\Commands;

use SimpleXMLElement;
use App\Models\Contact;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WebService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webserviceHlgest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update HLGest WebService Hourly';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $linkHlgest = DB::table('api_requests')->value('hlgest');
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
}
