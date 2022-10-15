@extends('layouts.app')
@section('content')
<div class="w-52 py-20 text-white px-8 bg-mainColor h-screen fixed">
    <a href="" class="text-white text-xl block">Event</a>
    <a href="" class="text-white text-xl mt-8 block ">Academy</a>
</div>

<div class="pt-20 pl-72 pr-12">
    <div class="w-[700px] mx-auto rounded p-8 shadow border">
        <form clas>

            <div class="flex gap-8 mt-10">
                <div class="w-full">
                    <label>Nama Materi</label>
                    <input type="text" name="namaMateri" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                </div>

                <div class="w-full">
                    <label>Link Materi</label>
                    <input type="text" name="linkMateri" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                </div>
            </div>

            <div class="flex justify-end">
                <input type="submit" value="Kirim" class="cursor-pointer rounded text-center w-28 py-1 mt-8 bg-mainColor text-white">
            </div>
        </form>
    </div>
</div>
@stop