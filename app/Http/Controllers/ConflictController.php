<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConflictController extends Controller
{
    public function conflicts(Request $request)
    {
        $telemovelDuplicados = Contact::getQuery()->whereIn('nmr_telemovel', array_column(DB::select('select nmr_telemovel from contacts group by nmr_telemovel having count(*) > 1'), 'nmr_telemovel'))->whereNotNull('nmr_telemovel')->orderBy('nmr_telemovel')->get();
        $duplicadriouse = collect([$telemovelDuplicados]);
        $duplicadosTelemovel =  $duplicadriouse->map(function ($item, $key) {
            return $item->groupBy('nmr_telemovel');
        });
        $duplicadosTelemovel->toArray();

        $allDuplicados = collect([$telemovelDuplicados]);
        $allDuplicadosTelemovel = $allDuplicados->map(function ($item, $key) {
            return $item->groupBy('nmr_telemovel');
        });
        // dd($allDuplicadosTelemovel);
        $contarTelemovel = 0;
        foreach ($duplicadosTelemovel as $dupli) {
            foreach ($dupli as $item) {
                for ($i = 0; $i < count($item); $i++) {
                    if ($item[$i]->usar_nmr_telemovel == 1) {
                        unset($dupli[$item[$i]->nmr_telemovel]);
                        $contarTelemovel--;
                        break;
                    }
                }
                $contarTelemovel++;
            }
        }

        $telefoneDuplicado = Contact::getQuery()->whereIn('nmr_escritorio', array_column(DB::select('select nmr_escritorio from contacts group by nmr_escritorio having count(*) > 1'), 'nmr_escritorio'))->whereNotNull('nmr_escritorio')->orderBy('nmr_escritorio')->get();
        $duplicadriousee = collect([$telefoneDuplicado]);
        $duplicadosTelefone =  $duplicadriousee->map(function ($item, $key) {
            return $item->groupBy('nmr_escritorio');
        });
        $duplicadosTelefone->toArray();

        $allDuplicadoss = collect([$telefoneDuplicado]);
        $allDuplicadosEscritorio = $allDuplicadoss->map(function ($item, $key) {
            return $item->groupBy('nmr_escritorio');
        });
        $contarTelefone = 0;
        foreach ($duplicadosTelefone as $duplic) {
            foreach ($duplic as $item) {
                for ($i = 0; $i < count($item); $i++) {
                    if ($item[$i]->usar_nmr_escritorio == 1) {
                        unset($duplic[$item[$i]->nmr_escritorio]);
                        $contarTelefone--;
                        break;
                    }
                }
                $contarTelefone++;
            }
        }
        $countConflitos = $contarTelefone + $contarTelemovel;

        $countContactos = Contact::count();
        $dados = ApiRequest::all();
        $data = Contact::latest()->paginate(15);
        $perPage = $request->perPage ?? 15;

        return view('conflicts', compact('data', 'countContactos', 'dados', 'telemovelDuplicados', 'telefoneDuplicado', 'duplicadosTelemovel', 'duplicadosTelefone', 'countConflitos', 'perPage', 'allDuplicadosTelemovel', 'allDuplicadosEscritorio'));
    }

    public function conflictsUpdateTelefone(Contact $contacto)
    {
        $contacto->usar_nmr_escritorio = 1;
        $contacto->save();

        return $contacto;
    }

    public function conflictsUpdateTelemovel(Contact $contacto)
    {
        $contacto->usar_nmr_telemovel = 1;
        $contacto->save();

        return $contacto;
    }
}
