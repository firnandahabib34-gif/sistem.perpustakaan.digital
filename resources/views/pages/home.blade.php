@extends('layouts.landing')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">

    <h1 class="text-4xl font-bold text-center text-blue-600">
        Home
    </h1>

    <p class="text-center text-gray-600 mt-4">
        Selamat datang di website kami
    </p>

    <div class="flex justify-center gap-6 mt-8 flex-wrap">
        <img 
            src="{{ asset('images/perpustakaan.jpg') }}"
            alt="Gambar 1"
            class="w-64 rounded-lg shadow-md"
        >

        <img 
            src="{{ asset('images/perpustakaan2.png') }}"
            alt="Gambar 2"
            class="w-64 rounded-lg shadow-md"
        >
    </div>

</div>
@endsection