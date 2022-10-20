@extends('layouts.app')
@section('content')

<div class="px-20 py-20">
    @if ($isGraduated)
    <div class="text-center mt-40">
        <h1 class="text-mainColor font-bold text-4xl mb-2">SELAMAT </h1>
        <h1 class="text-mainColor font-medium text-2xl">ANDA DINYATAKAN LULUS DALAM {{ strtoupper($event->nama) }}</h1>
        <p class="text-gray-500 text-lg mt-1 mb-8 ">Informasi Lebih Lanjut Akan Diumumkan Segera</p>
        <a href="/event" class="border hover:text-white hover:bg-mainColor transition ease-in duration-500 px-8 text-mainColor font-medium  rounded-full border-mainColor py-2">Kembali</a>
    </div>
    @else
    <div class="text-center mt-40">
        <h1 class="text-mainColor font-bold text-4xl mb-2">MOHON MAAF </h1>
        <h1 class="text-mainColor font-medium text-2xl mb-8">ANDA DINYATAKAN GAGAL DALAM {{ strtoupper($event->nama) }}</h1>
        <a href="/event" class="border hover:text-white hover:bg-mainColor transition ease-in duration-500 px-8 text-mainColor font-medium  rounded-full border-mainColor py-2">Kembali</a>
    </div>
    @endif
</div>

@stop