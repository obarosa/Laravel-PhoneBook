@extends('layout.master')
@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('main.importExcel') }}
            </h2>
        </x-slot>
        <div class="container">
            <div class="py-12">
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
                        <form action="{{ route('importExcel') }}" method="post" enctype="multipart/form-data">
                            <div class="d-flex p-6 bg-white ">
                                @csrf
                                <div class="col-5">
                                    <input class="form-control" name="fileExportExcel" type="file" id="formFile"
                                    accept=".xlsx">
                                </div>
                                <div class="col-7 ms-5">
                                    <button class="btn btn-info" type="submit">{{__('main.import')}}</button>
                                    <a class="btn btn-secondary" type="button"
                                        href="{{ route('dashboard.index') }}">{{__('main.voltar')}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if (session()->has('failures'))
                <div class="col-10 mx-auto">
                    <h1 class="fs-5 fw-bold mb-4">{{__('main.emailErro')}}</h1>
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
    </x-app-layout>

@endsection
