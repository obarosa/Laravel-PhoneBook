@extends('admin_dashboard')
@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('main.conflicts') }}
            </h2>
        </x-slot>

        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="row">
                    <p class="col-1"></p>
                    <p class="fs-5 fw-bold col-4">Conflitos com o Número Telemóvel:</p>
                    <p class="col-1"></p>
                    <p class="fs-5 fw-bold col-5 ms-5">Conflitos com o Número Telefone Escritório:</p>
                </div>

                <div
                    class="col-lg-5 bg-white p-4 ms-5 rounded-3 shadow-sm d-flex border-top mb-5 border-danger text-sm table-responsive-xxl mt-3 ">
                    <div class="col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <th scope="col">{{ __('main.pbx') }}</th>
                                <th class="text-center">{{ __('main.nmrTelemovel') }}</th>
                                <th class="text-center">{{ __('main.usa') }}</th>
                                <th class="text-center">{{ __('main.choose') }}</th>
                            </thead>
                            @if (count($allDuplicadosTelemovel) > 0)
                                @foreach ($allDuplicadosTelemovel as $key => $val)
                                    @foreach ($val as $item)
                                        @for ($i = 0; $i < count($item); $i++)
                                            <tbody class="align-middle">
                                                <td id="username" class="fw-bold corAzulPhoneBook p-3"><a
                                                        class="clipboardcopy" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Copy to clipboard"
                                                        data-clipboard-text="{{ $item[$i]->username }}"
                                                        style="cursor: pointer;">{{ $item[$i]->username }}</a>
                                                </td>
                                                <td id="nmr_telemovel" class="p-3 text-center fw-bold"><a
                                                        class="clipboardcopy" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Copy to clipboard"
                                                        data-clipboard-text="{{ $item[$i]->nmr_telemovel }}"
                                                        style="cursor: pointer;">{{ $item[$i]->nmr_telemovel }}</a>
                                                </td>
                                                @if ($item[$i]->usar_nmr_telemovel == 0)
                                                    <td id="usar_nmr_telemovel" class="text-center"><i
                                                            class='bx bx-x-circle bx-sm' style='color:#dc3545'></i>
                                                    </td>
                                                @else
                                                    <td id="usar_nmr_telemovel" class="text-center"><i
                                                            class='bx bx-check-circle bx-sm' style='color:#043e80'></i></td>
                                                @endif
                                                <td class="p-2 text-center">
                                                    <button class="btn btn-info btn-telefone-conflictsTelemovel"
                                                        rotaconflictsTelemovel="{{ route('dashboard.conflictsTelemovel.update', ['contacto' => $item[$i]->id]) }}"
                                                        type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24"
                                                            style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                                            <path
                                                                d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tbody>
                                        @endfor
                                        <td colspan="4" class="fw-bold p-3 table-danger"></td>
                                    @endforeach
                                @endforeach
                            @else
                                <td colspan="4" id="noData">{{ __('main.0conflitos') }}</td>
                            @endif
                        </table>
                    </div>
                </div>

                <div
                    class="col-lg-5 bg-white p-4 ms-5 rounded-3 shadow-sm d-flex border-top mb-5 border-danger text-sm table-responsive-xxl mt-3 ">
                    <div class="col-lg-12">
                        <table class="table table-hover">
                            <thead>
                                <th scope="col">{{ __('main.pbx') }}</th>
                                <th class="text-center">{{ __('main.nmrEscritorio') }}</th>
                                <th class="text-center">{{ __('main.usa') }}</th>
                                <th class="text-center">{{ __('main.choose') }}</th>
                            </thead>
                            @if ($allDuplicadosEscritorio != '[]')
                                @foreach ($allDuplicadosEscritorio as $key => $val)
                                    @foreach ($val as $item)
                                        @for ($i = 0; $i < count($item); $i++)
                                            <tbody class="align-middle">
                                                <tr id="linha_conflicts_{{ $item[$i]->id }}">

                                                    <td class="fw-bold corAzulPhoneBook p-3"><a class="clipboardcopy"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Copy to clipboard"
                                                            data-clipboard-text="{{ $item[$i]->username }}"
                                                            style="cursor: pointer;">{{ $item[$i]->username }}</a>
                                                    </td>
                                                    <td class="p-3 text-center fw-bold"><a class="clipboardcopy"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Copy to clipboard"
                                                            data-clipboard-text="{{ $item[$i]->nmr_escritorio }}"
                                                            style="cursor: pointer;">{{ $item[$i]->nmr_escritorio }}</a>
                                                    </td>
                                                    @if ($item[$i]->usar_nmr_escritorio == 0)
                                                        <td class="text-center"><i class='bx bx-x-circle bx-sm'
                                                                style='color:#dc3545'></i>
                                                        </td>
                                                    @else
                                                        <td class="text-center"><i class='bx bx-check-circle bx-sm'
                                                                style='color:#043e80'></i></td>
                                                    @endif
                                                    <td class="p-2 text-center">
                                                        <button class="btn btn-info btn-telefone-conflictsTelefone"
                                                            rotaConflictsTelefone="{{ route('dashboard.conflictsTelefone.update', ['contacto' => $item[$i]->id]) }}"
                                                            type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24"
                                                                style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
                                                                <path
                                                                    d="m10 15.586-3.293-3.293-1.414 1.414L10 18.414l9.707-9.707-1.414-1.414z">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endfor
                                        <td colspan="4" class="fw-bold p-3 table-danger"></td>
                                    @endforeach
                                @endforeach
                            @else
                                <td colspan="4" id="noData">{{ __('main.0conflitos') }}</td>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/conflicts.js') }}"></script>
    </x-app-layout>
@endsection
