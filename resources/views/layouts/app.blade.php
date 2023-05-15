@extends('layout.master')
@section('title', 'PhoneBook - Painel de Administração')
@section('content')
    {{-- <body > --}}
    <div class="font-sans antialiased">


        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
    {{-- </body> --}}
@endsection
