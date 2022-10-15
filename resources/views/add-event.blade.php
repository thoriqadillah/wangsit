@extends('layouts.app')
@section('content')
<div class="w-52 py-20 text-white px-8 bg-mainColor h-screen fixed">
    <a href="" class="text-white text-xl block">Event</a>
    <a href="" class="text-white text-xl mt-8 block ">Academy</a>
</div>

<div class="pt-20 pl-72 pr-12">
    <div class="w-[700px] mx-auto rounded p-8 shadow border">
        <form clas>
            <div>
                <label>Nama Event</label>
                <input type="text" name="namaEvent" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
            </div>

            <div class="flex gap-8 mt-10">
                <div class="w-full">
                    <label>Tanggal Pendaftaran</label>
                    <input type="date" name="tanggalPendaftaran" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                </div>

                <div class="w-full">
                    <label>Tanggal Tutup Pendaftaran</label>
                    <input type="date" name="tanggalTutupPendaftaran" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                </div>
            </div>

            <div class="flex gap-8 mt-10">
                <div class="w-full">
                    <label>Tanggal Pengumuman</label>
                    <input type="date" name="tanggalPengumuman" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                </div>

                <div class="w-full">
                    <label>Tanggal Akhir Pengumuman</label>
                    <input type="date" name="tanggalAkhirPengumuman" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                </div>
            </div>

            <label class="block mt-8">
                <span class="sr-only">Choose profile photo</span>
                <input type="file" class="block w-full text-sm text-slate-500
      file:mr-4 file:py-2 file:px-4
      file:rounded-full file:border-0
      file:text-sm file:font-semibold
      file:bg-violet-50 file:text-mainColor
      hover:file:bg-violet-100
    " />
            </label>

            <div class="flex justify-end">
                <input type="submit" value="Kirim" class="cursor-pointer rounded text-center w-28 py-1 mt-8 bg-mainColor text-white">
            </div>
        </form>
    </div>
</div>
@stop