@extends('layouts.app')
@section('content')
<div class="w-52 py-20 text-white px-8 bg-mainColor h-screen fixed">
    <a href="/admin/event" class="text-white text-xl block">Event</a>
    <a href="/admin/academy" class="text-white text-xl mt-8 block ">Academy</a>
</div>

<div class="pt-20 pl-60 pr-8">
    <h1 class=" text-2xl font-medium">List Academy</h1>

    <div class="flex flex-wrap flex-row-reverse justify-between items-end">
        <span class="px-8 text-center py-2 border rounded-full border-grey-800" title="Departement {{ $userDept->nama }}">{{ $userDept->nama }}</span>
        <a href="/admin/academy/tambah" class="py-2 px-2 rounded-full bg-mainColor text-white mt-8 block w-60 text-center">Tambah Academy</a>
    </div>

    @foreach ($academy as $acdmy)
    <div class="mt-8 grid grid-cols-3 gap-8 mb-12">
        <div class="w-96 h-96 bg-white border rounded shadow relative p-5">
            <form action="/admin/academy/{{ $acdmy->id }}/delete" method="POST">
                @csrf
                @method('DELETE')
                <button><img src="{{url('/asset/icons/close.svg')}}" alt="" class="absolute cursor-pointer -top-3 -right-4" >
            </form>
            
            <div class="w-full h-52">
                <img src="{{url('/asset/icons/thumbnail2.png')}}" alt="" class="w-full h-full">
            </div>
            <div class="mt-5 flex flex-col h-28 justify-between">
                <div>
                    <h1 class="font-medium uppercase text-center">{{ $acdmy->nama }}</h1>
                </div>
                <div class="flex gap-4">
                    <a class="border border-white rounded-md cursor-pointer grow block text-center text-white py-2 bg-mainColor" href="/admin/academy/{{ $acdmy->slug }}">EDIT</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="flex justify-center items-center my-8">
        <div class="flex gap-4 items-center">
            <img src="{{url('/asset/icons/kiri.svg')}}" alt="" class="w-10 cursor-pointer">
            <img src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
        </div>
    </div>
</div>
@stop