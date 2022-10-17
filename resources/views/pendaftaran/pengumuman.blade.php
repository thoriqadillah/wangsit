@extends('layouts.app')
@section('content')

<div class="px-20 py-20">
    <!-- hasil lulus -->
    <!-- <div class="text-center mt-40">
        <h1 class="text-mainColor font-medium text-2xl mb-2">SELAMAT </h1>
        <h1 class="text-mainColor font-medium text-2xl">ANDA DINYATAKAN LULUS SEBAGAI PANITIA STARSHIP 2022</h1>
        <p class="text-gray-500 text-lg mt-5 mb-8 ">Informasi Lebih Lanjut Akan Diumumkan Segera</p>
        <a href="/event" class="border hover:text-white hover:bg-mainColor transition ease-in duration-500 px-8 text-mainColor font-medium  rounded-full border-mainColor py-2">Back</a>
    </div> -->

    <!-- hasil gagal -->
    <div class="text-center mt-40">
        <h1 class="text-mainColor font-medium text-2xl mb-2">MOHON MAAF </h1>
        <h1 class="text-mainColor font-medium text-2xl mb-8">ANDA DINYATAKAN GAGAL SELEKSI PANITIA STARSHIP 2022</h1>
        <a href="/event" class="border hover:text-white hover:bg-mainColor transition ease-in duration-500 px-8 text-mainColor font-medium  rounded-full border-mainColor py-2">Back</a>
    </div>
</div>

@stop