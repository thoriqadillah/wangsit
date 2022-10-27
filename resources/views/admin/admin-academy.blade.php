@extends('layouts.app')
@section('content')
<div class="pt-24 px-6 lg:px-20">
    @include('layouts.flash-message')
    <div class="flex justify-between items-center w-full mt-8">
        <a href="/admin/academy/tambah" class="py-2 rounded-full bg-mainColor text-white text-sm block w-40 text-center">Tambah Academy</a>
        <div class="px-8 text-center py-2 border rounded-full border-grey-800 text-sm" title="Departement {{ $userDept->nama }}">{{ $userDept->nama }}</div>
    </div>

    <div class="gap-x-8 gap-y-10 justify-items-center grid grid-col-1 lg:grid-cols-3 2xl:grid-cols-4 sm:grid-cols-2 mt-10">
        @foreach ($academy as $acdmy)
        <div class="w-80 sm:w-full md:w-[360px] lg:w-full h-96 flex flex-col items-center bg-white border rounded shadow relative p-3">
            <form action="/admin/academy/{{ $acdmy->id }}/delete" method="POST">
                @csrf
                @method('DELETE')
                <button><img src="{{url('/asset/icons/close.svg')}}" alt="" class="absolute cursor-pointer -top-3 -right-4">
            </form>

            <div class="w-full h-52">
                <img src="{{url('/asset/icons/thumbnail2.png')}}" alt="" class="w-full h-full">
            </div>

            <div class="mt-5 flex flex-col h-28 justify-between">
                <div class="overflow-hidden">
                    <h1 class="font-medium uppercase text-center">{{ $acdmy->nama }}</h1>
                </div>
                <div class="flex gap-4">
                    <a class="border border-white rounded-md cursor-pointer grow block text-center text-white py-2 bg-mainColor" href="/admin/academy/{{ $acdmy->slug }}">EDIT</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{--
    <div class="flex gap-4 items-center justify-center my-4">
        <img src="{{url('/asset/icons/kiri.svg')}}" alt="" class="w-10 cursor-pointer">
        <img src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
    </div>
    --}}
</div>
@stop