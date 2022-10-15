@extends('layouts.app')
@section('content')
<div class="w-52 py-20 text-white px-8 bg-mainColor h-screen fixed">
    <a href="" class="text-white text-xl block">Event</a>
    <a href="" class="text-white text-xl mt-8 block ">Academy</a>
</div>

<div class="pt-20 pl-72 pr-12">
    <div class="w-[800px] mx-auto">
        <h1 class=" text-2xl font-medium">Form Starship 2021</h1>

        <form class="mb-20">

            <!-- add form text -->
            <div class="w-full border rounded shadow bg-white p-8 mt-8">
                <!-- dropdown jenis input -->
                <label for="countries" class="block mb-2 text-gray-900">Jenis Form</label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg outline-none py-2 px-3 w-80">
                    <option value="Text" selected>Text</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="Textarea">Textarea</option>
                    <option value="Dropdown">Dropdown</option>
                    <option value="Radio">Radio</option>
                </select>
                <!-- dropdown jenis input -->

                <!-- input nama dan place holder -->
                <div class="flex gap-8 mt-10">
                    <div class="w-full">
                        <label>Judul</label>
                        <input type="text" name="judul" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                    </div>

                    <div class="w-full">
                        <label>Placeholder</label>
                        <input type="text" name="placeHolder" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                    </div>
                </div>
                <!-- input nama dan place holder -->


                <!-- checkbox required -->
                <div class="flex items-center mt-8 gap-2">
                    <input id="checked-checkbox" type="checkbox" value="true" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500">
                    <label for="checked-checkbox" class="ml-2 font-medium text-gray-900">Is Required</label>
                </div>
                <!-- checkbox required -->


                <!-- tolbol tambah dan hapus input -->
                <div class="flex gap-4 mt-8 w-80">
                    <button class="border border-mainColor text-mainColor rounded bg-white grow py-2">Tambah Input</button>
                    <button class="border border-newRed text-newRed rounded bg-white grow py-2">Hapus Input</button>
                </div>
                <!-- tolbol tambah dan hapus input -->

            </div>
            <!-- add form text -->


            <!-- add form checkbox -->
            <div class="w-full border rounded shadow bg-white p-8 mt-8">
                <!-- dropdown jenis input -->
                <label for="countries" class="block mb-2 text-gray-900">Jenis Form</label>
                <select class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg outline-none py-2 px-3 w-80">
                    <option value="Checkbox" selected>Checkbox</option>
                    <option value="Text">Text</option>
                    <option value="Textarea">Textarea</option>
                    <option value="Dropdown">Dropdown</option>
                    <option value="Radio">Radio</option>
                </select>
                <!-- dropdown jenis input -->


                <!-- input nama dan place holder -->
                <div class="flex gap-8 mt-10">
                    <div class="w-full">
                        <label>Judul</label>
                        <input type="text" name="judul" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                    </div>

                    <div class="w-full">
                        <label>Placeholder</label>
                        <input type="text" name="placeHolder" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                    </div>
                </div>
                <!-- input nama dan place holder -->


                <!-- checkbox required -->
                <div class="flex items-center mt-8 gap-2">
                    <input id="checked-checkbox" type="checkbox" value="true" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500">
                    <label for="checked-checkbox" class="ml-2 font-medium text-gray-900">Is Required</label>
                </div>
                <!-- checkbox required -->


                <!-- tolbol tambah dan hapus input -->
                <div class="flex gap-4 mt-8 w-80">
                    <button class="border border-mainColor text-mainColor rounded bg-white grow py-2">Tambah Input</button>
                    <button class="border border-newRed text-newRed rounded bg-white grow py-2">Hapus Input</button>
                </div>
                <!-- tolbol tambah dan hapus input -->


                <div class="rounded bg-white shadow border p-8 mt-10 mx-3 relative">
                    <!-- hapus input -->
                    <img src="{{url('/asset/icons/close.svg')}}" alt="" class="absolute cursor-pointer -top-3 -right-4">
                    <!-- hapus input -->

                    <!-- nama dan value opsi -->
                    <h1 class="font-bold">Opsi Pilihan 1</h1>
                    <div class="flex gap-8 mt-4">
                        <div class="w-full">
                            <label>Judul Opsi</label>
                            <input type="text" name="namaMateri" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                        </div>

                        <div class="w-full">
                            <label>Value Opsi</label>
                            <input type="text" name="linkMateri" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                        </div>
                    </div>
                    <!-- nama dan value opsi -->


                    <!-- tambah opsi lain -->
                    <div class="flex gap-4 mt-8 w-40">
                        <button class="border border-mainColor text-mainColor rounded bg-white grow py-2">Tambah Opsi</button>
                    </div>
                    <!-- tambah opsi lain -->

                </div>
            </div>
            <!-- add form checkbox -->

        </form>
    </div>
</div>
@stop