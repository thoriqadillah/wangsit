@extends('layouts.app')
@section('content')

<div class="mx-96 py-20">
    <div class="mt-5 bg-white border shadow rounded py-16 px-24">
        <h1 class="text-2xl font-medium text-mainColor mb-12">Form Pendaftaran Kepanitian Starship 2022</h1>
        <form class="flex flex-col gap-12">
            <div>
                <label class="block mb-2 text-lg font-medium text-gray-600">Nama Lengkap</label>
                <input type="text" class="w-full border px-3 py-2 bg-gray-50 rounded border-gray-300 outline-none">
            </div>

            <div>
                <label class="block mb-2 text-lg font-medium text-gray-600">NIM</label>
                <input type="text" class="w-full border px-3 py-2 bg-gray-50 rounded border-gray-300 outline-none">
            </div>

            <div>
                <label class="block mb-4 text-lg font-medium text-gray-600">Jenis Kelamin</label>

                <div class="flex items-center mb-2">
                    <input id="default-radio-1" type="radio" value="" name="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pria</label>
                </div>

                <div class="flex items-center">
                    <input id="default-radio-2" type="radio" value="" name="radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Perempuan</label>
                </div>
            </div>

            <div>
                <label class="block mb-2 text-lg font-medium text-gray-600">Jenis Kelamin</label>
                <select class="w-full border px-3 py-2 rounded border-gray-300 outline-none" name="" id="">
                    <option selected value="1">NONDEPT</option>
                    <option selected value="2">MEDKOMINFO</option>
                    <option selected value="3">ADVOKESMA</option>
                    <option selected value="4">PSDM</option>
                    <option selected value="5">P2S</option>
                    <option selected value="6">KWU</option>
                    <option selected value="7">SOSMA</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-lg font-medium text-gray-600">Deskripsikan Diri Anda</label>
                <textarea class="block p-4 h-24 w-full outline-none bg-gray-50 rounded-lg border border-gray-300 resize-none"></textarea>
            </div>

            <div>
                <label class="block mb-2 text-lg font-medium text-gray-600">Link Drive Biodata</label>
                <input type="text" class="w-full border px-3 py-2 bg-gray-50 rounded border-gray-300 outline-none">
            </div>

            <div>
                <div class="flex items-center gap-4">
                    <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300">Dengan ini saya menyetujui seluruh prasyarat yang ada</label>
                </div>
            </div>

            <div>
                <input type="submit" value="Kirim" class="w-full cursor-pointer rounded bg-mainColor py-2 text-white text-lg">
            </div>
        </form>
    </div>
</div>

@stop