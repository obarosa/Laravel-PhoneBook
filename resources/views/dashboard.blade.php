@extends('layout.master')
@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('main.contactos') }}
            </h2>
        </x-slot>

        <div class="container">
            {{-- ------- MINI HEADER ------- --}}
            <div
                class="row mt-4 col-lg-10 mx-auto bg-white p-4 rounded-3 shadow-sm d-flex align-items-center border-bottom border-primary">
                <div class="col-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        style="fill: black;transform: ;msFilter:;">
                        <a href="{{ route('utilizador.dashboard.index') }}">
                            <path class="homeButton"
                                d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z">
                            </path>
                        </a>
                    </svg>
                </div>
                <div class="col-1"></div>
                <div class="col-6">

                </div>
                <div class="col-4">
                    {{-- <form action="{{ route('utilizador.dashboard.search') }}" method="GET"> --}}
                    <div class="input-group rounded">
                        <input type="search" id="search" class="form-control rounded" placeholder="Search"
                            value="{{ request()->has('queryUtilizador') ? request()->query('queryUtilizador') : '' }}"
                            aria-label="Search" name="queryUtilizador" aria-describedby="search-addon"
                            style="max-width: 300px;" />
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
                class="mt-3 col-lg-10 mx-auto bg-white px-4 py-3 rounded-3 shadow-sm d-flex align-items-center border-top text-sm table-responsive-xxl">
                <div class="col-lg-12">
                    <table class="table table-hover" id="tableContacts">
                        <thead>
                            <tr>
                                <th scope="col" style="max-width: 2px;"></th>
                                <th scope="col">{{ __('main.pbx') }}</th>
                                <th scope="col">{{ __('main.company') }}</th>
                                <th scope="col" class="text-center">{{ __('main.nmrTelemovel') }}</th>
                                <th scope="col" class="text-center" style="max-width: 150px;">
                                    {{ __('main.nmrEscritorio') }}</th>
                                <th scope="col" class="text-center" style="max-width: 120px;">{{ __('main.nmrCasa') }}
                                </th>
                                <th class="" style="max-width: 115px;">
                                    <span class="ms-2">{{ __('main.acoes') }}</span>
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
                                                <form action="{{ route('utilizador.dashboard.index') }}" method="GET">
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
                                                    @if (request()->has('queryUtilizador'))
                                                        <input type="hidden" name="queryUtilizador"
                                                            value="{{ request()->query('queryUtilizador') }}">
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
                            @foreach ($data as $value)
                                <tr id="linha_{{ $value->id }}">
                                    <td>
                                        @if ($value->favorito == 1)
                                            <a type="button" class="position-relative" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalDetalhes-{{ $value->id }}">
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
                                                data-bs-target="#exampleModalDetalhes-{{ $value->id }}">
                                                <i class='bx bx-user bx-sm' style='color:#043e80'>
                                                </i>
                                            </a>
                                        @endif
                                    </td>
                                    <td style="max-width: auto"><a class="fw-bold corAzulPhoneBook clipboardcopy"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard"
                                            data-clipboard-text="{{ $value->username }}"
                                            style="cursor: pointer;">{{ $value->username }}</a>
                                    </td>
                                    <td><a class="text-center clipboardcopy" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Copy to clipboard"
                                            data-clipboard-text="{{ $value->empresa }}" style="cursor: pointer;">
                                            {{ $value->empresa }}</a>
                                    </td>
                                    @if ($value->nmr_telemovel == null)
                                        <td></td>
                                    @else
                                        <td {{ $value->usar_nmr_telemovel == 0 ? 'style=color:red' : 'style=color:black' }}
                                            class="text-center" id="nmrTelemovelChecked">
                                            <a class="clipboardcopy" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Copy to clipboard"
                                                data-clipboard-text="{{ $value->nmr_telemovel }}"
                                                style="cursor: pointer;">{{ $value->nmr_telemovel }}
                                            </a>
                                            <a href="sip:{{ $value->nmr_telemovel }}"><i
                                                    class='bx bx-mobile bx-sm ms-1 text-center' style='color:#043e80'></i>
                                            </a>
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
                                                style="cursor: pointer;">{{ $value->nmr_escritorio }}
                                            </a>
                                            <a href="sip:{{ $value->nmr_escritorio }}"><i class='bx bxs-phone-call bx-sm'
                                                    style='color:#043e80'></i>
                                            </a>
                                        </td>
                                    @endif
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
                                    <td class="d-grid">
                                        <button type="button" class="btn btn-info me-1" data-bs-toggle="modal"
                                            data-bs-target="#exampleModalDetalhes-{{ $value->id }}">Detalhes
                                            {{-- <img src="{{ asset('assets/images/view.png') }}" alt=""
                                                style="width: 20px; margin:auto;"> --}}
                                        </button>
                                        <!-- Modal Detalhes -->
                                        <div class="modal fade" id="exampleModalDetalhes-{{ $value->id }}"
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row mt-4">
                        <div class="d-flex justify-content-center" id="dataTablespagination">
                            {{-- {{ $data->appends(compact('perPage'))->onEachSide(0)->links() }} --}}
                        </div>
                        <div class="text-end text-muted"
                            style="margin-top: -26px; margin-left: -20px!important; margin-bottom: 20px;">
                            {{ $countContactos }} contactos</div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="text-muted text-center mt-5 p-3 bg-white">
                Developed by<a href="https://github.com/obarosa" target="_blank" class="corAzulPhoneBook fw-bold"> António Barosa</a>
            </div>
        </footer>
        <script src="{{ asset('js/user_contact.js') }}"></script>
    </x-app-layout>
@endsection
