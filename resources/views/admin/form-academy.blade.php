@extends('layouts.app')
@section('content')
<div class="w-52 py-20 text-white px-8 bg-mainColor h-screen fixed">
    <a href="/admin/event" class="text-white text-xl block">Event</a>
    <a href="/admin/academy" class="text-white text-xl mt-8 block ">Academy</a>
</div>

<div class="pt-20 pl-72 pr-12">
    <div class="w-[700px] mx-auto rounded p-8 shadow border">
        <form class method="POST" action="{{ isset($detail) ? '/admin/academy/'. $detail->id  : '/admin/academy/tambah' }}">
            @if (isset($detail))
            @method('PUT')
            @endif
            @csrf
            <div class="flex gap-8 mt-10">
                <div class="w-full">
                    <label>Nama Materi</label>
                    <input type="text" name="nama" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor" value="{{ isset($detail->nama) ? $detail->nama : '' }}">
                </div>

                <div class="w-full">
                    <label>Link Materi</label>
                    <input type="text" name="link" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor" value="{{isset ($detail->link) ? $detail->link : '' }}">
                </div>
            </div>
            
            <div class="flex gap-8 mt-6">
                <div class="w-1/2">
                    <label for="countries" class="block mb-2 text-gray-900">Kategori Materi</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg outline-none py-2 px-3 w-80" name="academy_category_id">
                        <option  value="{{isset ($detail->academy_category_id) ? $detail->academy_category_id : '' }}" selected>{{ isset ($detail->namaK) ? $detail->namaK : '' }}</option>
                        @foreach ($materi as $m) 
                            @if (isset($detail) && $detail->academy_category_id == $m->id)
                            <option selected value="{{ $m->id }}">{{ $m->nama }}</option>
                            @else
                            <option value="{{ $m->id }}">{{ $m->nama }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <input type="submit" value="Simpan" class="cursor-pointer rounded text-center w-28 py-1 mt-8 bg-mainColor text-white">
            </div>
        </form>
    </div>
</div>
@stop