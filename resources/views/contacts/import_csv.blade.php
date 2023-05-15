@extends('layout.master')
@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('main.importCSV') }}
            </h2>
        </x-slot>
        <div class="container">
            <div class="pt-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    @if (session('status'))
                        <div class="alert alert-success col-6 mt-2" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('erro'))
                    <div class="alert alert-danger col-6 mt-2" role="alert">
                        {{ session('erro') }}
                    </div>
                    @endif
                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger col-6 mt-2">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg  border-bottom border-primary">
                        <div class="d-flex p-6 bg-white">
                            <form action="{{ route('importCsv') }}" class="row" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-8">
                                    <input class="form-control" name="fileExportCsv" type="file" id="formFile"
                                        accept=".csv">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-info" type="submit">{{ __('main.carregar') }}</button>
                                    <a class="btn btn-secondary" type="button"
                                        href="{{ route('dashboard.index') }}">{{ __('main.voltar') }}</a>
                                </div>
                            </form>
                            @if (count($csvContacts) > 0)
                                <a class="btn btn-primary" href="{{ route('transferData') }}"
                                    type="submit">{{ __('main.import') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="col-lg-10 mx-auto bg-white p-4 mt-4 rounded-3 shadow-sm d-flex align-items-center border-top text-sm table-responsive-xxl ">
                <div class="col-lg-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">1: {{ __('main.pbx') }}</th>
                                <th scope="col">2: {{ __('main.nome') }}</th>
                                <th scope="col">3: {{ __('main.empresa') }}</th>
                                <th scope="col">4: {{ __('main.email') }}</th>
                                <th scope="col">5: {{ __('main.nmrTelemovel') }}</th>
                                <th scope="col">6: {{ __('main.nmrEscritorio') }}</th>
                                <th scope="col">7: {{ __('main.nmrCasa') }}</th>
                                <th scope="col">8: {{ __('main.notas') }}</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle" id="table_contactos">
                            @if (count($csvContacts) > 0)
                                @foreach ($csvContacts as $data)
                                    <tr id="linha_csv_{{ $data->id }}">
                                        <td class="p-3 fw-bold corAzulPhoneBook">{{ $data->username }}</td>
                                        <td class="p-3">{{ $data->pri_nome }}</td>
                                        <td class="p-3">{{ $data->empresa }}</td>
                                        <td class="p-3">{{ $data->email }}</td>
                                        <td class="p-3">{{ $data->nmr_telemovel }}</td>
                                        <td class="p-3">{{ $data->nmr_escritorio }}</td>
                                        <td class="p-3">{{ $data->nmr_casa }}</td>
                                        <td class="">{{ $data->notas }}</td>
                                        <td style="min-width: 60px;">
                                            <button
                                                rota_csv="{{ route('importContactsCsv.destroy', ['csv_contacto' => $data->id]) }}"
                                                data-id-csv="{{ $data->id }}" type="button"
                                                class="btn btn-danger btn-delete-csv" onclick="confirmAction()">
                                                <img src="{{ asset('assets/images/trash.png') }}" alt=""
                                                    style="width: 20px;">
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td colspan="8" class="fw-bold">{{ __('main.0data') }}</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if (session()->has('failures'))
                <div class="col-10 mx-auto mt-2">
                    <h1 class="fs-5 fw-bold mb-3">{{ __('main.emailErroCarregado') }}</h1>
                    <table class="table table-hover table-danger col-10">
                        <tr>
                            <th>{{ __('main.linha') }}:</th>
                            <th>{{ __('main.atr') }}:</th>
                            <th>{{ __('main.error') }}:</th>
                            <th>{{ __('main.value') }}:</th>
                        </tr>
                        @foreach (session()->get('failures') as $validation)
                            <tr>
                                <td>{{ $validation->row() }}</td>
                                <td>{{ $validation->attribute() }}</td>
                                <td>
                                    <ul>
                                        @foreach ($validation->errors() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    {{ $validation->values()[$validation->attribute()] }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
        <script src="{{ asset('js/csv_contact.js') }}"></script>
    </x-app-layout>

@endsection
