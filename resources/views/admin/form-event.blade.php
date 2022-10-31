@extends('layouts.app')
@section('content')

<div class="py-20">
    <div class="w-[700px] mx-auto rounded p-8 shadow border">
        <form class method="POST" action="{{ isset($detail) ? '/admin/event/'.$detail->id : '/admin/event/tambah'}}" enctype="multipart/form-data">
            @if (isset($detail))
            @method('PUT')
            @endif
            @csrf
            <input type="hidden" name="thumbnailLama" value="{{ $detail->thumbnail ?? '' }}">
            <div class="flex gap-8 mt-10 items-center">
                <div class="w-full">
                    <label>
                        Nama Event
                        @error('nama')
                        <span class="text-newRed text-sm">*{{$message}}</span>
                        @enderror
                    </label>
                    <input type="text" name="nama" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor" value="{{ isset($detail->nama) ? $detail->nama : old('nama') ?? '' }}">
                </div>
            </div>

            <div class="flex gap-8 mt-10">
                <div class="w-full">
                    <label>
                        Tanggal Pendaftaran
                    </label>
                    <input type="date" name="tgl_buka_pendaftaran" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor" value="{{ isset($detail->tgl_buka_pendaftaran) ? date('Y-m-d',strtotime($detail->tgl_buka_pendaftaran)) : old('tgl_buka_pendaftaran') ?? '' }}">
                    @error('tgl_buka_pendaftaran')
                    <div class="text-newRed text-sm">*{{$message}}</div>
                    @enderror
                </div>

                <div class="w-full">
                    <label>Tanggal Tutup Pendaftaran</label>
                    <input type="date" name="tgl_tutup_pendaftaran" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor" value="{{ isset($detail->tgl_tutup_pendaftaran) ? date('Y-m-d',strtotime($detail->tgl_tutup_pendaftaran)) : old('tgl_tutup_pendaftaran') ?? '' }}">
                    @error('tgl_tutup_pendaftaran')
                    <div class="text-newRed text-sm">*{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="flex gap-8 mt-10">
                <div class="w-full">
                    <label>Tanggal Pengumuman</label>
                    <input type="date" name="tgl_buka_pengumuman" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor" value="{{isset( $detail->tgl_buka_pengumuman) ? date('Y-m-d',strtotime($detail->tgl_buka_pengumuman)) : old('tgl_buka_pengumuman') ?? '' }}">
                    @error('tgl_buka_pengumuman')
                    <div class="text-newRed text-sm">*{{$message}}</div>
                    @enderror
                </div>

                <div class="w-full">
                    <label>Tanggal Akhir Pengumuman</label>
                    <input type="date" name="tgl_tutup_pengumuman" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor" value="{{ isset($detail->tgl_tutup_pengumuman) ? date('Y-m-d',strtotime($detail->tgl_tutup_pengumuman)) : old('tgl_tutup_pengumuman') ?? '' }}">
                    @error('tgl_tutup_pengumuman')
                    <div class="text-newRed text-sm">*{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="flex flex-row mt-3 content-center">
                <img src="{{ isset($detail) ? Storage::url($detail->thumbnail) : ' ' }}" class="{{ isset($detail) ? '' : 'hidden' }}" alt=" " id="preview-img" class="mr-2" style="width: 50px; height: 50px;">
                <label class="block ">
                    <span class="sr-only">Choose Thumbnail Event</span>
                    <input onchange="loadfile(event)" type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-mainColor hover:file:bg-violet-100 my-2" name="thumbnail"/>
                    @error('thumbnail')
                    <div class="text-newRed text-sm">*{{$message}}</div>
                    @enderror
                </label>
            </div>

            <div class="flex items-center mt-8 gap-2">
                {{-- <input type="hidden" name="adanya_kelulusan" value="true"> --}}
                <input id="checked-checkbox" type="checkbox" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500" name="adanya_kelulusan" {{ isset($detail->adanya_kelulusan) ? (($detail->adanya_kelulusan = 1) ? "" : "checked" ): "" }}>
                <label for="checked-checkbox" class="ml-2 font-medium text-gray-900">Jadikan Event Tanpa Kelulusan</label>
            </div>

            <div class="flex justify-end">
                <input type="submit" value="Simpan" class="cursor-pointer rounded text-center w-28 py-1 mt-8 bg-mainColor text-white">
            </div>
        </form>
    </div>
</div>

<script>
    function loadfile(event) {
        const img = document.getElementById('preview-img')
        img.classList = ''
        img.src = URL.createObjectURL(event.target.files[0])
    }
</script>
@stop