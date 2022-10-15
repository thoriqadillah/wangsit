@extends('layouts.app')
@section('content')
<img src="{{url('/asset/icons/logo.png')}}" class="block mx-auto mt-28 md:mt-10" />

<div class="grid grid-cols-1 lg:grid-cols-2 px-5 mt-5 lg:mt-10">
    <div class="hidden lg:block ml-44">
        <img src="{{url('/asset/icons/ilustrasi1.png')}}" class="block mx-auto w-96" />

        <h1 class="font-bold text-3xl mt-8">Wangsit Auth</h1>
        <p class="mt-3">
            Warung Angkringan SI Terhits (WANGSIT) merupakan sebuah sistem autentikasi untuk mahasiswa program studi Sistem Informasi FILKOM UB, di dalamnya terdapat Wangsit Event yang berisi informasi seputar event yang ada di KBMSI serta Wangsit Academy yang berisi materi-materi pembelajaran yang ada di Sistem Informasi.
        </p>
    </div>

    <div class="w-full md:px-40 lg:px-44">
        <form class="border border-mainColor rounded shadow mt-5" method="POST" action="/login">
            @csrf
            <div class="w-full text-center py-3 font-medium text-xl bg-mainColor rounded-t text-white shadow-md">
                Login
            </div>
            <div class="px-4 w-full flex-col flex gap-5 lg:gap-8 my-8">
                <input type="text" class="bg-gray-100 p-2 rounded placeholder:text-[#8690d2] outline-mainColor lg:text-lg" placeholder="NIM" name="nim" required />
                <input type="password" class="bg-gray-100 p-2 rounded placeholder:text-[#8690d2] outline-mainColor lg:text-lg" placeholder="Password" name="password" required />
                <input type="submit" value="Login" class="block bg-mainColor text-white w-full rounded py-2 mt-3 lg:mt-8 cursor-pointer" />
            </div>
        </form>
    </div>
</div>
@stop