<?php

namespace App\Http\Controllers;

use App\Models\ExportDefinicion;
use Illuminate\Http\Request;

class ExportDefinicionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'yealink_name' => '',
            'yealink_directory' => '',
            'microsip_name' => '',
            'microsip_directory' => '',
            'grandstream_name' => '',
            'grandstream_directory' => '',
            'gigaset_name' => '',
            'gigaset_directory' => '',
        ]);

        $dados = ExportDefinicion::updateOrCreate(
            [
                'id' =>  1
            ],
            [
                'yealink_name' =>  request('yealink_name'),
                'yealink_directory' => request('yealink_directory'),
                'microsip_name' => request('microsip_name'),
                'microsip_directory' => request('microsip_directory'),
                'grandstream_name' => request('grandstream_name'),
                'grandstream_directory' => request('grandstream_directory'),
                'gigaset_name' => request('gigaset_name'),
                'gigaset_directory' => request('gigaset_directory'),
            ]
        );

        return back()->with('dados', $dados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExportDefinicion  $exportDefinicion
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $exportDados = ExportDefinicion::all();
        return $exportDados;
    }
}
