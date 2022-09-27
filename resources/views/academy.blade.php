@extends('layouts.layouts')
@section('content')

<div class="px-8 lg:px-20 py-20 lg:py-28">
    <div>
        <h1 class="font-bold text-center text-mainColor text-2xl">WANGSIT Academy</h1>
        <form class="relative">
            <img src="{{url('/asset/Search.svg')}}" alt="seacrh" class="absolute w-5 top-3 left-4 lg:left-[405px]">
            <input type="text" class="block mx-auto lg:w-[600px] w-full mt-4 lg:mt-10 rounded-full outline-mainColor border shadow py-2 p-12 pr-4" placeholder="search" />
        </form>
    </div>

    <div class="grid grid-col-1 lg:grid-cols-3 mt-8 gap-8 lg:gap-16 lg:px-20">
        <div class="w-full shadow-xl">
            <div class="w-full h-60">
                <img src="{{url('/asset/thumbnail2.png')}}" class="w-full h-full object-cover" />
            </div>
            <div class="p-4">
                <div>
                    <h1 class="text-lg text-mainColor text-center">Administrasi Basis Data</h1>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>

        <div class="w-full shadow-xl">
            <div class="w-full h-60">
                <img src="{{url('/asset/thumbnail2.png')}}" class="w-full h-full object-cover" />
            </div>
            <div class="p-4">
                <div>
                    <h1 class="text-lg text-mainColor text-center">Administrasi Basis Data</h1>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>

        <div class="w-full shadow-xl">
            <div class="w-full h-60">
                <img src="{{url('/asset/thumbnail2.png')}}" class="w-full h-full object-cover" />
            </div>
            <div class="p-4">
                <div>
                    <h1 class="text-lg text-mainColor text-center">Administrasi Basis Data</h1>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>
    </div>
</div>
@stop