@extends('layouts.app')
@section('content')
<div class="w-52 py-20 text-white px-8 bg-mainColor h-screen fixed">
    <a href="/admin/event" class="text-white text-xl block">Event</a>
    <a href="/admin/academy" class="text-white text-xl mt-8 block ">Academy</a>
</div>

<div class="pt-20 pl-72 pr-12">
    <div class="w-[700px] mx-auto rounded p-8 shadow border">
        <form clas>
            <div class="flex gap-8 mt-10 items-center">
                <div class="w-full">
                    <label>Nama Event</label>
                    <input type="text" name="namaEvent" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                </div>
                <div class="w-full">
                    <label>Nama Departemen</label>
                    <select class="border rounded py-2 px-3 mt-3 w-full" name="namaDepartemen" id="">
                        <option selected value="1">NONDEPT</option>
                        <option selected value="2">MEDKOMINFO</option>
                        <option selected value="3">ADVOKESMA</option>
                        <option selected value="4">PSDM</option>
                        <option selected value="5">P2S</option>
                        <option selected value="6">KWU</option>
                        <option selected value="7">SOSMA</option>
                    </select>
                </div>


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


            <label class="block mb-3 mt-8">Gambar Event</label>
            <label class="block ">
                <span class="sr-only">Choose Thumbnail Event</span>
                <input type="file" class="block w-full text-sm text-slate-500
      file:mr-4 file:py-2 file:px-4
      file:rounded-full file:border-0
      file:text-sm file:font-semibold
      file:bg-violet-50 file:text-mainColor
      hover:file:bg-violet-100
    " />
            </label>

            <div class="flex items-center mt-8 gap-2">
                <input id="checked-checkbox" type="checkbox" value="false" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500">
                <label for="checked-checkbox" class="ml-2 font-medium text-gray-900">Jadikan Event Tanpa Kelulusan</label>
            </div>

            <div class="flex justify-end">
                <input type="submit" value="Kirim" class="cursor-pointer rounded text-center w-28 py-1 mt-8 bg-mainColor text-white">
            </div>
        </form>
    </div>
</div>
@stop