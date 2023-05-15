@extends('layout.master')
@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('main.painelAdmContactos') }}
            </h2>
        </x-slot>

        <div class="container">
            @if (session('status'))
                <div class="row mt-3">
                    <div class="alert alert-success alert-dismissible fade show col-10 mx-auto" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <span class="row mt-3 fw-bold statuswarning" style="display: none;">
                <div class="alert alert-warning alert-dismissible fade show col-10 mx-auto align-middle" role="alert">
                    <div class="row">
                        <span class="col-sm-3 mt-1">Aguarde pelo Download !</span>
                        <span class="spinner-border col-sm-2" role="status" aria-hidden="true">
                            <span class="sr-only">Loading...</span>
                        </span>
                    </div>
                </div>
            </span>

            {{-- ------- MINI HEADER ------- --}}
            <div
                class="row fw-bold mt-4 col-lg-10 mx-auto bg-white p-4 rounded-3 shadow-sm d-flex align-items-center border-bottom border-primary">
                <div class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        style="fill: black;transform: ;msFilter:;">
                        <a href="{{ route('dashboard.index') }}">
                            <path class="homeButton"
                                d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z">
                            </path>
                        </a>
                    </svg>
                </div>
                <div class="col"><a href="#" data-bs-toggle="modal"
                        data-bs-target="#exampleModalNovoContacto">{{ __('main.novoContacto') }}</a>
                </div>
                <div class="col dropdown ms-4">
                    <div class="dropdown-toggle" id="dropdownMenuButtonExport" data-bs-toggle="dropdown"
                        aria-expanded="false" data-bs-offset="10,20"><a href="">
                            {{ __('main.export') }}</a>
                    </div>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonExport">
                        <li><a class="dropdown-item exportDropdown" href="{{ route('dashboard.exportYealinkXml') }}"
                                target="_blank">Yealink</a>
                            <a href="{{ route('dashboard.downloadYealinkXml') }}"
                                class="btn btn-secondary downloadFilesXML">XML</a>
                        </li>
                        <li><a class="dropdown-item exportDropdown" href="{{ route('dashboard.exportMicrosipXml') }}"
                                target="_blank">MicroSIP</a>
                            <a href="{{ route('dashboard.downloadMicrosipXml') }}"
                                class="btn btn-secondary downloadFilesXML">XML</a>
                        </li>
                        <li><a class="dropdown-item exportDropdown" href="{{ route('dashboard.exportGrandstreamXml') }}"
                                target="_blank">Grandstream -
                                GXP21xx_GXP14xx_GXP116X</a>
                            <a href="{{ route('dashboard.downloadGrandstreamXml') }}"
                                class="btn btn-secondary downloadFilesXML">XML</a>
                        </li>
                        <li><a class="dropdown-item exportDropdown" href="{{ route('dashboard.exportGigasetXml') }}"
                                target="_blank">Gigaset</a>
                            <a href="{{ route('dashboard.downloadGigasetXml') }}"
                                class="btn btn-secondary downloadFilesXML">XML</a>
                        </li>
                        <li id="pdfButtonAncora" class="pdfButton d-grid border-top" style="margin: 5px 0px -6px 1px;">
                        </li>
                    </ul>
                </div>
                @foreach ($dados as $val)
                    <div class="col dropdown me-1">
                        <div class="dropdown-toggle" id="dropdownMenuButtonImport" data-bs-toggle="dropdown"
                            aria-expanded="false" data-bs-offset="10,20"> <a href="">
                                {{ __('main.import') }}</a>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonImport">
                            <li><a class="dropdown-item" href="{{ route('importContactsCsv') }}">CSV</a></li>
                            <li><a class="dropdown-item" href="{{ route('importContactsExcel') }}">EXCEL</a></li>
                            <hr id="hrImportar"
                                @if ($val->atualizacao == 'horas' || $val->usar_hlgest == 0) style="display:none"
                            @else style="display:block" @endif>
                            <li><a class="dropdown-item" id="hlgestDropdown" rotaHlgest={{ route('dashboard.hlgest') }}
                                    @if ($val->atualizacao == 'horas' || $val->usar_hlgest == 0) style="display:none"
                                    @else style="display:block" @endif>HLGEST</a>
                            </li>
                            <li><a class="dropdown-item" id="primaveraDropdown"
                                    rotaPrimavera={{ route('dashboard.primavera') }}
                                    @if ($val->atualizacao == 'horas' || $val->usar_primavera == 0) style="display:none"
                                    @else style="display:block" @endif>PRIMAVERA</a>
                            </li>
                            <li><a class="dropdown-item" id="phcDropdown" rotaPhc={{ route('dashboard.phc') }}
                                    @if ($val->atualizacao == 'horas' || $val->usar_phc == 0) style="display:none"
                                @else style="display:block" @endif>PHC</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <a href="{{ route('dashboard.conflicts') }}">{{ __('main.conflitos') }}<span
                                class="badge bg-danger ms-2">{{ $countConflitos }}</span></a>
                    </div>
                    <div class="col dropdown">
                        <div class="dropdown-toggle" id="dropdownDefinicoes" data-bs-toggle="dropdown" aria-expanded="false"
                            data-bs-offset="10,20"><a href="">
                                {{ __('main.definicoes') }}</a>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdownDefinicoes">
                            <li>
                                <a class="dropdown-item modalWebServices" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalWebServices"
                                    rotaa="{{ route('dashboard.WebServices.edit') }}">WebService
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item modalExportDefinicions" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalExports"
                                    rotaExportDefinicion="{{ route('dashboard.exportdefinicion.edit') }}">{{ __('main.exports') }}</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Modal Definicoes Exports -->
                    <div class="modal fade" id="exampleModalExports" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" aria-labelledby="exampleModalExports" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="post" action="{{ route('dashboard.exportdefinicion.store') }}"
                                enctype="multipart/form-data" onsubmit="event.preventDefault();">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalExports">
                                            {{ __('main.definicoes') }} Exportação - PhoneBook
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <a class="corAzulPhoneBook fw-bold" style="cursor: default;">YEALINK</a><br>
                                                <hr>
                                                <label for="yealink_name" class="col-form-label webServicesForm">Nome
                                                    Ficheiro:</label>
                                                <input type="text" id="yealink_name" class="form-control">
                                                <label for="yealink_directory"
                                                    class="col-form-label webServicesForm">Diretório:</label>
                                                <input type="text" id="yealink_directory" class="form-control">
                                            </div>
                                            <div class="col-6">
                                                <a class="corAzulPhoneBook fw-bold"
                                                    style="cursor: default;">MICROSIP</a><br>
                                                <hr>
                                                <label for="microsip_name" class="col-form-label webServicesForm">Nome
                                                    Ficheiro:</label>
                                                <input type="text" id="microsip_name" class="form-control">
                                                <label for="microsip_directory"
                                                    class="col-form-label webServicesForm">Diretório:</label>
                                                <input type="text" id="microsip_directory" class="form-control">
                                            </div>
                                            <div class="col-6 mt-4">
                                                <a class="corAzulPhoneBook fw-bold"
                                                    style="cursor: default;">GRANDSTREAM</a><br>
                                                <hr>
                                                <label for="grandstream_name" class="col-form-label webServicesForm">Nome
                                                    Ficheiro:</label>
                                                <input type="text" id="grandstream_name" class="form-control">
                                                <label for="grandstream_directory"
                                                    class="col-form-label webServicesForm">Diretório:</label>
                                                <input type="text" id="grandstream_directory" class="form-control">
                                            </div>
                                            <div class="col-6 mt-4">
                                                <a class="corAzulPhoneBook fw-bold" style="cursor: default;">GIGASET</a><br>
                                                <hr>
                                                <label for="gigaset_name" class="col-form-label webServicesForm">Nome
                                                    Ficheiro:</label>
                                                <input type="text" id="gigaset_name" class="form-control">
                                                <label for="gigaset_directory"
                                                    class="col-form-label webServicesForm">Diretório:</label>
                                                <input type="text" id="gigaset_directory" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">{{ __('main.fechar') }}</button>
                                        <button type="submit" id="ExportDefinicionsGuardar"
                                            class="btn btn-info">{{ __('main.guardarAlt') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Modal Definicoes WebServices -->
                    <div class="modal fade" id="exampleModalWebServices" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" aria-labelledby="exampleModalWebServices" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="post" action="{{ route('dashboard.WebServices.store') }}"
                                enctype="multipart/form-data" onsubmit="event.preventDefault();">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalWebServices">
                                            {{ __('main.definicoes') }} WebService - PhoneBook
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="hlGestURLcheckbox">
                                            <label class="form-check-label" for="hlGestURLcheckbox">
                                                HLGest WebService URL:
                                            </label>
                                            <input type="text" class="form-control" aria-label="" id="hlGestURLinput">
                                        </div>
                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="primaveraURLcheckbox">
                                            <label class="form-check-label" for="primaveraURLcheckbox">
                                                Primavera WebService URL:
                                            </label>
                                            <input type="text" class="form-control" aria-label="" id="primaveraURLinput">
                                        </div>
                                        <div class="form-check mt-4">
                                            <input class="form-check-input" type="checkbox" value="" id="phcURLcheckbox">
                                            <label class="form-check-label" for="phcURLcheckbox">
                                                Phc WebService URL:
                                            </label>
                                            <input type="text" class="form-control" aria-label="" id="phcURLinput">
                                        </div>
                                        <div class="form-check mt-3">
                                            <label class="form-check-label" for="freqAtualizacoesSelect">
                                                {{ __('main.updtFreq') }}:
                                            </label>
                                            <select class="form-select selectFreqAtual mt-2" id="freqAtualizacoesSelect"
                                                aria-label="Default select example">

                                                {{ __('main.nenhum') }}
                                                <option value="horas" id="todaHoraDefinicoes"
                                                    @if (old('atualizacao', $val->atualizacao) === 'horas') selected='selected' @endif>
                                                    {{ __('main.todaHora') }}</option>
                                                <option value="manualmente" id="manualmenteDefinicoes"
                                                    @if (old('atualizacao', $val->atualizacao) === 'manualmente') selected='selected' @endif>
                                                    {{ __('main.manualmente') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">{{ __('main.fechar') }}</button>
                                        <button type="submit" id="WebServicesGuardar"
                                            class="btn btn-info">{{ __('main.guardarAlt') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
                <div class="col-3">
                    {{-- <form action="{{ route('dashboard.search') }}" method="GET"> --}}
                    <div class="input-group rounded">
                        <input type="search" name="query" id="search"
                            value="{{ request()->has('query') ? request()->query('query') : '' }}"
                            class="form-control rounded searchInput" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" style="max-width: 228px;" />
                        <span class="input-group-text border-0" id="search-addon">
                            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    style="fill: white;transform: ;msFilter:;">
                                    <path
                                        d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z">
                                    </path>
                                </svg>
                            </button>
                        </span>
                        @if (request()->has('perPage'))
                            <input type="hidden" name="perPage" value="{{ request()->query('perPage') }}">
                        @endif
                    </div>
                    {{-- </form> --}}
                </div>
            </div>

            {{-- ------- TABELA COM OS CONTACTOS ------- --}}
            <div
                class="col-lg-10 mx-auto bg-white px-4 py-2 rounded-3 shadow-sm d-flex align-items-center border-top text-sm table-responsive-xxl mt-3 ">
                <div class="col-lg-12">
                    <table class="table table-hover" id="tableContacts">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">{{ __('main.pbx') }}</th>
                                <th scope="col" class="">{{ __('main.company') }}</th>
                                <th scope="col" class="text-center">{{ __('main.nmrCasa') }}</th>
                                <th scope="col" class="text-center" style="min-width: 90px">
                                    {{ __('main.nmrTelemovel') }}</th>
                                <th scope="col" class="text-center">{{ __('main.nmrEscritorio') }}</th>
                                <th scope="col" class="text-center">{{ __('main.usaNmrTelemovel') }}</th>
                                <th scope="col" class="text-center" style="max-width: 65px;">
                                    {{ __('main.usaNmrEscritorio') }}</th>
                                <th style="margin-top: 15px;"><span class="ms-2">{{ __('main.acoes') }}</span>
                                    <div class="dropdown float-end">
                                        <button class="btn btn-light dropdown-toggle d-flex" type="button"
                                            id="dropdownMenuClickableInside" data-bs-toggle="dropdown"
                                            data-bs-auto-close="outside" aria-expanded="false">
                                            <i class='bx bx-filter-alt'></i></button>
                                        <ul class="dropdown-menu dropdown-menu-end filtros text-sm"
                                            aria-labelledby="dropdownMenuClickableInside">
                                            <li class="text-center mb-1">{{ __('main.filtros') }}</li>
                                            <hr>
                                            {{-- <li class="tituloDropdown">{{ __('main.perPage') }}</li>
                                            <li>
                                                <form action="{{ route('dashboard.index') }}" method="GET">
                                                    <select onchange="this.form.submit()"
                                                        class="form-select form-select-sm mt-2 ms-3" id="pagination"
                                                        name="perPage" style="width: 87%;">
                                                        <option value="15"
                                                            @if ($perPage == 15) selected @endif>15
                                                        </option>
                                                        <option value="50"
                                                            @if ($perPage == 50) selected @endif>50
                                                        </option>
                                                        <option value="100"
                                                            @if ($perPage == 100) selected @endif>100
                                                        </option>
                                                        <option value="{{ $countContactos }}"
                                                            @if ($perPage == $countContactos) selected @endif>Todos
                                                        </option>
                                                    </select>
                                                    @if (request()->has('query'))
                                                        <input type="hidden" name="query"
                                                            value="{{ request()->query('query') }}">
                                                    @endif
                                                </form>
                                            </li> --}}
                                            <li class="tituloDropdown mt-2">{{ __('main.perPage') }}</li>
                                            <li id="dataTableperPage" class="ms-3 mt-2"></li>
                                        </ul>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="table_contactos">
                            {{-- @if (count($data) > 0) --}}
                            @foreach ($data as $value)
                                {{-- {{ dd($value->toArray()) }} --}}
                                <tr id="linha_{{ $value->id }}">
                                    <td>
                                        @if ($value->favorito == 1)
                                            <a type="button" class="position-relative" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal-{{ $value->id }}">
                                                <i class='bx bx-user bx-sm' style='color:#043e80'>
                                                    <span class="position-absolute top-0 start-100 translate-middle p-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12"
                                                            fill="#ffd700" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                            <path
                                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                        </svg>
                                                    </span>
                                                </i>
                                            </a>
                                        @else
                                            <a type="button" class="position-relative" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal-{{ $value->id }}">
                                                <i class='bx bx-user bx-sm' style='color:#043e80'>
                                                </i>
                                            </a>
                                        @endif
                                    </td>
                                    <td style="min-width: 170px;"><a class="fw-bold corAzulPhoneBook clipboardcopy"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard"
                                            data-clipboard-text="{{ $value->username }}"
                                            style="cursor: pointer;">{{ $value->username }}</a>
                                    </td>
                                    <td class=""><a class="clipboardcopy" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Copy to clipboard"
                                            data-clipboard-text="{{ $value->empresa }}" style="cursor: pointer;">
                                            {{ $value->empresa }}</a>
                                    </td>
                                    @if ($value->nmr_casa == null)
                                        <td></td>
                                    @else
                                        <td class="text-center"><a class="text-center clipboardcopy"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard"
                                                data-clipboard-text="{{ $value->nmr_casa }}" style="cursor: pointer;">
                                                {{ $value->nmr_casa }}</a>
                                            <a href="sip:{{ $value->nmr_casa }}"><i class='bx bxs-phone bx-sm'
                                                    style='color:#043e80'></i>
                                            </a>
                                        </td>
                                    @endif
                                    @if ($value->nmr_telemovel == null)
                                        <td></td>
                                    @else
                                        <td {{ $value->usar_nmr_telemovel == 0 ? 'style=color:red' : 'style=color:black' }}
                                            class="text-center" id="nmrTelemovelChecked">
                                            <a class="clipboardcopy" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Copy to clipboard"
                                                data-clipboard-text="{{ $value->nmr_telemovel }}"
                                                style="cursor: pointer;">{{ $value->nmr_telemovel }}</a>
                                            <a href="sip:{{ $value->nmr_telemovel }}"><i class='bx bx-mobile bx-sm'
                                                    style='color:#043e80'></i></a>
                                        </td>
                                    @endif
                                    @if ($value->nmr_escritorio == null)
                                        <td></td>
                                    @else
                                        <td {{ $value->usar_nmr_escritorio == 0 ? 'style=color:red' : 'style=color:black' }}
                                            class="text-center" id="nmrEscritorioChecked">
                                            <a class="clipboardcopy" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Copy to clipboard"
                                                data-clipboard-text="{{ $value->nmr_escritorio }}"
                                                style="cursor: pointer;">{{ $value->nmr_escritorio }}</a>
                                            <a href="sip:{{ $value->nmr_escritorio }}"><i class='bx bxs-phone-call bx-sm'
                                                    style='color:#043e80'></i></a>
                                        </td>
                                    @endif

                                    @if ($value->usar_nmr_telemovel == 0)
                                        <td class="text-center"><i class='bx bx-x-circle bx-sm'
                                                style='color:#dc3545'></i></td>
                                    @else
                                        <td class="text-center"><i class='bx bx-check-circle bx-sm'
                                                style='color:#043e80'></i></td>
                                    @endif
                                    @if ($value->usar_nmr_escritorio == 0)
                                        <td class="text-center"><i class='bx bx-x-circle bx-sm'
                                                style='color:#dc3545'></i></td>
                                    @else
                                        <td class="text-center"><i class='bx bx-check-circle bx-sm'
                                                style='color:#043e80'></i></td>
                                    @endif

                                    <td class="d-flex justify-content-end py-3">
                                        <button type="button" class="btn btn-info me-1" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-{{ $value->id }}">
                                            <img src="{{ asset('assets/images/view.png') }}" alt="" style="width: 20px;">
                                        </button>
                                        <!-- Modal Detalhes -->
                                        <div class="modal fade" id="exampleModal-{{ $value->id }}"
                                            data-filtro="{{ $value->id }}" tabindex="-1" data-bs-backdrop="static"
                                            data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ $value->username }}</h5>
                                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button> --}}
                                                    </div>
                                                    <div class="modal-body align-middle">
                                                        <table class="table table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row" style="min-width: 170px; width: 180px;">
                                                                        {{ __('main.idcontacto') }}</th>
                                                                    <td
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        {{ $value->id }}
                                                                        <a class='bx bx-clipboard bx-sm clipboardcopyDetalhes'
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="Copy to clipboard"
                                                                            data-clipboard-text="{{ $value->id }}"
                                                                            style='cursor: pointer;'>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">
                                                                        {{ __('main.nickname') }}</th>
                                                                    @if ($value->username == '')
                                                                        <td class=""></td>
                                                                    @else
                                                                        <td
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            {{ $value->username }}
                                                                            <a class='bx bx-clipboard bx-sm clipboardcopyDetalhes'
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Copy to clipboard"
                                                                                data-clipboard-text="{{ $value->username }}"
                                                                                style='cursor: pointer;'>
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">
                                                                        {{ __('main.tipo') }}</th>
                                                                    <td>{{ $value->tipo }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">
                                                                        {{ __('main.grupo') }}</th>
                                                                    <td>{{ $value->grupo }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">{{ __('main.favorito') }}
                                                                    </th>
                                                                    @if ($value->favorito == 1)
                                                                        <td><input class="form-check-input" type="checkbox"
                                                                                value="" id="flexCheckDisabled" checked
                                                                                disabled>
                                                                        </td>
                                                                    @else
                                                                        <td><input class="form-check-input" type="checkbox"
                                                                                value="" id="flexCheckDisabled" disabled>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">{{ __('main.empresa') }}</th>
                                                                    @if ($value->empresa == '')
                                                                        <td class=""></td>
                                                                    @else
                                                                        <td
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            {{ $value->empresa }}
                                                                            <a class='bx bx-clipboard bx-sm clipboardcopyDetalhes'
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Copy to clipboard"
                                                                                data-clipboard-text="{{ $value->empresa }}"
                                                                                style='cursor: pointer;'>
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">{{ __('main.email') }}</th>
                                                                    @if ($value->email == '')
                                                                        <td class=""></td>
                                                                    @else
                                                                        <td
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            {{ $value->email }}
                                                                            <a class='bx bx-clipboard bx-sm clipboardcopyDetalhes'
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Copy to clipboard"
                                                                                data-clipboard-text="{{ $value->email }}"
                                                                                style='cursor: pointer;'>
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">{{ __('main.priNome') }}</th>
                                                                    @if ($value->pri_nome == '')
                                                                        <td class=""></td>
                                                                    @else
                                                                        <td
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            {{ $value->pri_nome }}
                                                                            <a class='bx bx-clipboard bx-sm clipboardcopyDetalhes'
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Copy to clipboard"
                                                                                data-clipboard-text="{{ $value->pri_nome }}"
                                                                                style='cursor: pointer;'>
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">{{ __('main.apelido') }}</th>
                                                                    @if ($value->apelido == '')
                                                                        <td class=""></td>
                                                                    @else
                                                                        <td
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            {{ $value->apelido }}
                                                                            <a class='bx bx-clipboard bx-sm clipboardcopyDetalhes'
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Copy to clipboard"
                                                                                data-clipboard-text="{{ $value->apelido }}"
                                                                                style='cursor: pointer;'>
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">
                                                                        {{ __('main.nmrEscritorio') }}
                                                                    </th>
                                                                    @if ($value->nmr_escritorio == '')
                                                                        <td class=""></td>
                                                                    @else
                                                                        <td
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            {{ $value->nmr_escritorio }}
                                                                            <a class='bx bx-clipboard bx-sm clipboardcopyDetalhes'
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Copy to clipboard"
                                                                                data-clipboard-text="{{ $value->nmr_escritorio }}"
                                                                                style='cursor: pointer;'>
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">
                                                                        {{ __('main.nmrTelemovel') }}
                                                                    </th>
                                                                    @if ($value->nmr_telemovel == '')
                                                                        <td class=""></td>
                                                                    @else
                                                                        <td
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            {{ $value->nmr_telemovel }}
                                                                            <a class='bx bx-clipboard bx-sm clipboardcopyDetalhes'
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Copy to clipboard"
                                                                                data-clipboard-text="{{ $value->nmr_telemovel }}"
                                                                                style='cursor: pointer;'>
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">{{ __('main.nmrCasa') }}
                                                                    </th>
                                                                    @if ($value->nmr_casa == '')
                                                                        <td class=""></td>
                                                                    @else
                                                                        <td
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            {{ $value->nmr_casa }}
                                                                            <a class='bx bx-clipboard bx-sm clipboardcopyDetalhes'
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Copy to clipboard"
                                                                                data-clipboard-text="{{ $value->nmr_casa }}"
                                                                                style='cursor: pointer;'>
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">{{ __('main.notas') }}</th>
                                                                    @if ($value->notas == '')
                                                                        <td class=""></td>
                                                                    @else
                                                                        <td
                                                                            class="d-flex align-items-center justify-content-between">
                                                                            <span>{{ $value->notas }}</span>
                                                                            <a class='bx bx-clipboard bx-sm clipboardcopyDetalhes'
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top"
                                                                                title="Copy to clipboard"
                                                                                data-clipboard-text="{{ $value->notas }}"
                                                                                style='cursor: pointer;'>
                                                                            </a>
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer detalhesModalFooter">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">{{ __('main.fechar') }}</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <button type="button" class="btn btn-success me-1" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalEditarContacto-{{ $value->id }}"
                                            data-id-editar="{{ $value->id }}">
                                            <img src="{{ asset('assets/images/edit.png') }}" alt=""
                                                style="width: 20px;">
                                        </button>



                                        <button rota="{{ route('dashboard.destroy', ['contacto' => $value->id]) }}"
                                            data-id="{{ $value->id }}" type="button" class="btn btn-danger btn-delete"
                                            onclick="confirmAction()">
                                            <img src="{{ asset('assets/images/trash.png') }}" alt=""
                                                style="width: 20px;">
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- @else
                                <td colspan="9" class="fw-bold">{{ __('main.0data') }}</td>
                            @endif --}}
                        </tbody>
                    </table>

                    @foreach ($data as $value)
                        <!-- Modal Editar Contacto -->
                        <form class="form-modal-editar"
                            action="{{ route('dashboard.update', ['contacto' => $value->id]) }}" method="POST">
                            @csrf
                            <div class="modal fade" id="exampleModalEditarContacto-{{ $value->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalEditarContacto">
                                                {{ $value->username }} -
                                                {{ __('main.editarContacto') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body g-3">
                                            <div class="row">
                                                <div class="col-6">
                                                    <label for="username" class="form-label">Username:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="username"
                                                            aria-describedby="inputGroupPrepend2"
                                                            value="{{ old('username', $value->username) }}">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label for="email"
                                                        class="form-label">{{ __('main.email') }}:</label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="{{ $value->email }}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-4">
                                                    <label for="empresa"
                                                        class="form-label">{{ __('main.empresa') }}:</label>
                                                    <input type="text" class="form-control" name="empresa"
                                                        value="{{ $value->empresa }}">
                                                </div>
                                                <div class="col-4">
                                                    <label for="pri_nome"
                                                        class="form-label">{{ __('main.firstName') }}:</label>
                                                    <input type="text" class="form-control" name="pri_nome"
                                                        placeholder="" value="{{ $value->pri_nome }}">
                                                </div>
                                                <div class="col-4">
                                                    <label for="apelido"
                                                        class="form-label">{{ __('main.lastName') }}:</label>
                                                    <input type="text" class="form-control" name="apelido"
                                                        value="{{ $value->apelido }}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-4">
                                                    <label for="nmr_escritorio"
                                                        class="form-label">{{ __('main.nmrEscritorio') }}:</label>
                                                    <input type="number" class="form-control" name="nmr_escritorio"
                                                        placeholder="" value="{{ $value->nmr_escritorio }}">
                                                </div>
                                                <div class="col-4">
                                                    <label for="nmr_telemovel"
                                                        class="form-label">{{ __('main.nmrTelemovel') }}:</label>
                                                    <input type="number" class="form-control" name="nmr_telemovel"
                                                        placeholder="" value="{{ $value->nmr_telemovel }}">
                                                </div>
                                                <div class="col-4">
                                                    <label for="nmr_casa"
                                                        class="form-label">{{ __('main.nmrCasa') }}:</label>
                                                    <input type="number" class="form-control" name="nmr_casa"
                                                        placeholder="" value="{{ $value->nmr_casa }}">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-4">
                                                    <div class="form-check">
                                                        @if ($value->favorito == 1)
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="favorito" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="favorito">
                                                        @endif
                                                        <label class="form-check-label" for="favorito">
                                                            {{ __('main.favorito') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if ($value->usar_nmr_telemovel == 1)
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="usar_nmr_telemovel" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="usar_nmr_telemovel">
                                                        @endif
                                                        <label class="form-check-label" for="usar_nmr_telemovel">
                                                            {{ __('main.usaNumeroTelemovel') }}
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if ($value->usar_nmr_escritorio == 1)
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="usar_nmr_escritorio" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                name="usar_nmr_escritorio">
                                                        @endif
                                                        <label class="form-check-label" for="usar_nmr_escritorio">
                                                            {{ __('main.usaTelefoneEscritorio') }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <label for="tipo"
                                                        class="form-label">{{ __('main.tipo') }}:</label>
                                                    <select class="form-select" name="tipo">
                                                        <option value="nenhum"
                                                            @if (old('tipo', $value->tipo) === 'nenhum') selected='selected' @endif>
                                                            {{ __('main.nenhum') }}
                                                        </option>
                                                        <option value="vip"
                                                            @if (old('tipo', $value->tipo) === 'vip') selected='selected' @endif>
                                                            VIP</option>
                                                        <option value="lista_negra"
                                                            @if (old('tipo', $value->tipo) === 'lista_negra') selected='selected' @endif>
                                                            {{ __('main.listaNegra') }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label for="grupo"
                                                        class="form-label">{{ __('main.grupo') }}:</label>
                                                    <select class="form-select" name="grupo">
                                                        <option value="nenhum"
                                                            @if (old('tipo', $value->grupo) === 'nenhum') selected='selected' @endif>
                                                            {{ __('main.nenhum') }}
                                                        </option>
                                                        <option value="amigos"
                                                            @if (old('tipo', $value->grupo) === 'amigos') selected='selected' @endif>
                                                            {{ __('main.amigos') }}</option>
                                                        <option value="familia"
                                                            @if (old('tipo', $value->grupo) === 'familia') selected='selected' @endif>
                                                            {{ __('main.familia') }}</option>
                                                        <option value="trabalho"
                                                            @if (old('tipo', $value->grupo) === 'trabalho') selected='selected' @endif>
                                                            {{ __('main.trabalho') }}</option>
                                                        <option value="lista_colegas"
                                                            @if (old('tipo', $value->grupo) === 'lista_colegas') selected='selected' @endif>
                                                            {{ __('main.listaColegas') }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3 mb-2">
                                                <div class="col-12">
                                                    <label for="notas"
                                                        class="form-label">{{ __('main.notas') }}:</label>
                                                    <textarea class="form-control" name="notas" rows="3" style="height: 42px">{{ $value->notas }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">{{ __('main.fechar') }}</button>
                                            <button type="submit"
                                                class="btn btn-info btn-edit">{{ __('main.guardarAlt') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach
                    <div class="row mt-4">
                        <div class="d-flex justify-content-center" id="dataTablespagination">
                            {{-- {{ $data->appends(compact('perPage'))->onEachSide(0)->links() }} --}}
                        </div>
                        <div class="text-end text-muted"
                            style="margin-top: -26px; margin-left: -20px!important; margin-bottom: 20px;">
                            {{ $countContactos }} contactos
                        </div>
                    </div>
                </div>
            </div>

            <!--!! Modal Novo Contacto -->
            <div class="modal fade" id="exampleModalNovoContacto" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form method="post" action="{{ route('dashboard.store') }}" enctype="multipart/form-data"
                        onsubmit="event.preventDefault();">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalNovoContacto">PhoneBook -
                                    {{ __('main.novoContacto') }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body g-3 text-sm">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="validationDefaultUsername" class="form-label">Username:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                id="validationDefaultUsernameCreateContact"
                                                aria-describedby="inputGroupPrepend2"
                                                placeholder="{{ __('main.obrigatorio') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="inputEmail4" class="form-label">{{ __('main.email') }}:</label>
                                        <input type="email" class="form-control" id="inputEmail4CreateContact"
                                            placeholder="{{ __('main.obrigatorio') }}" required>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <label for="validationDefault03"
                                            class="form-label">{{ __('main.empresa') }}:</label>
                                        <input type="text" class="form-control" id="validationDefault03CreateContact">
                                    </div>
                                    <div class="col-4">
                                        <label for="validationDefault01"
                                            class="form-label">{{ __('main.firstName') }}:</label>
                                        <input type="text" class="form-control" id="validationDefault01CreateContact"
                                            placeholder="" value="">
                                    </div>
                                    <div class="col-4">
                                        <label for="validationDefault02"
                                            class="form-label">{{ __('main.lastName') }}:</label>
                                        <input type="text" class="form-control" id="validationDefault02CreateContact"
                                            value="">

                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <label for="validationDefault06"
                                            class="form-label">{{ __('main.nmrEscritorio') }}:</label>
                                        <input type="number" class="form-control" id="validationDefault06CreateContact"
                                            placeholder="" value="">
                                    </div>
                                    <div class="col-4">
                                        <label for="validationDefault07"
                                            class="form-label">{{ __('main.nmrTelemovel') }}:</label>
                                        <input type="number" class="form-control" id="validationDefault07CreateContact"
                                            placeholder="" value="">
                                    </div>
                                    <div class="col-4">
                                        <label for="validationDefault08"
                                            class="form-label">{{ __('main.nmrCasa') }}:</label>
                                        <input type="number" class="form-control" id="validationDefault08CreateContact"
                                            placeholder="" value="">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="favorito"
                                                id="flexCheckDefaultCreateContact">
                                            <label class="form-check-label" for="flexCheckDefaultCreateContact">
                                                {{ __('main.favorito') }}
                                            </label>
                                        </div>
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" value="usaNmrTlfEscrt"
                                                id="flexCheckCheckedUsaTlfEscrt">
                                            <label class="form-check-label" for="flexCheckCheckedUsaTlfEscrt">
                                                {{ __('main.usaTelefoneEscritorio') }}
                                            </label>
                                        </div>
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" value="usaNmrTelemovel"
                                                id="flexCheckCheckedUsaNmrTelemovel">
                                            <label class="form-check-label" for="flexCheckCheckedUsaNmrTelemovel">
                                                {{ __('main.usaNumeroTelemovel') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="validationDefault05CreateContact"
                                            class="form-label">{{ __('main.tipo') }}:</label>
                                        <select class="form-select" id="validationDefault05CreateContact">
                                            <option selected value="nenhum">{{ __('main.nenhum') }}</option>
                                            <option value="vip">VIP</option>
                                            <option value="lista_negra">{{ __('main.listaNegra') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="validationDefault09CreateContact"
                                            class="form-label">{{ __('main.grupo') }}:</label>
                                        <select class="form-select" id="validationDefault09CreateContact">
                                            <option selected value="nenhum">{{ __('main.nenhum') }}</option>
                                            <option value="amigos">{{ __('main.amigos') }}</option>
                                            <option value="familia">{{ __('main.familia') }}</option>
                                            <option value="trabalho">{{ __('main.trabalho') }}</option>
                                            <option value="lista_colegas">{{ __('main.listaColegas') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-2">
                                    <div class="col-12">
                                        <label for="exampleFormControlTextarea1CreateContact"
                                            class="form-label">{{ __('main.notas') }}:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1CreateContact" rows="3"
                                            style="height: 42px"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light"
                                    data-bs-dismiss="modal">{{ __('main.fechar') }}</button>
                                <button type="submit" id="modalCreateContactSumbit"
                                    class="btn btn-info">{{ __('main.addContacto') }}</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <footer>
            <div class="text-muted text-center mt-5 p-3 bg-white">
                Developed by<a href="https://github.com/obarosa" target="_blank" class="corAzulPhoneBook fw-bold"> António Barosa</a>
            </div>
        </footer>

        <script src="{{ asset('js/contact.js') }}"></script>

    </x-app-layout>
@endsection
