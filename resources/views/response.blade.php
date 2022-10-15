@extends('layouts.app')
@section('content')


<div class="pt-20 px-10">
    <h1 class=" text-2xl font-medium"> Event Starship</h1>

    <div class="flex justify-between items-center">
        <div class="flex items-center gap-8">
            <a href="" class="py-2 rounded-full bg-white border border-mainColor text-mainColor mt-8 block w-40 text-center">Add Academy</a>
            <a href="" class="py-2 rounded-full bg-white border border-mainColor text-mainColor mt-8 block w-40 text-center">Preview Form</a>
        </div>

        <div class="flex gap-4 items-center">
            <img src="{{url('/asset/icons/kiri.svg')}}" alt="" class="w-10 cursor-pointer">
            <img src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
        </div>
    </div>


    <div class="w-full relative border overflow-y-auto mt-12 mb-20 customScroll">
        <table class="w-full text-sm text-left text-gray-500 border-collapse">
            <thead class="text-xs text-black uppercase bg-blue-100 text-center">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Nama Mahasiswa
                    </th>
                    <th scope="col" class="py-3 px-6">
                        NIM
                    </th>
                    <th scope="col" class="py-3 px-12">
                        Pengalaman 1
                    </th>
                    <th scope="col" class="py-3 px-12">
                        Pengalaman 2
                    </th>
                    <th scope="col" class="py-3 px-40">
                        Alasan Mendaftar
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Link Google Drive
                    </th>
                    <th scope="col" class="py-3 px-12">
                        Prestasi 1
                    </th>
                    <th scope="col" class="py-3 px-12">
                        Prestasi 2
                    </th>
                    <th scope="col" class="py-3 px-12">
                        Divisi 1
                    </th>
                    <th scope="col" class="py-3 px-12">
                        Divisi 2
                    </th>
                    <th scope="col" class="py-3 px-12">
                        Tanggal Lahir
                    </th>
                    <th scope="col" class="py-3 px-12">
                        Tempat Lahir
                    </th>
                    <th scope="col" class="py-3 px-12">
                        Nomer HP
                    </th>
                    <th scope="col" class="py-3 px-12">
                        ID Line
                    </th>
                    <th scope="col" class="py-3 px-12">
                        Lulus
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b align-top">
                    <td scope="row" class="p-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Abdurrizqo Arrahman
                    </td>
                    <td class="py-4 px-6">
                        195150401111026
                    </td>
                    <td class="py-4 px-6">
                        Ketua Divisi Kegiatan Mahasiswa
                    </td>
                    <td class="py-4 px-6">
                        Anggota Mahasiswa Sistem Informasi Filkom
                    </td>
                    <td class="py-4 px-6 w-96">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend imperdiet erat a congue. Morbi eros augue, pretium fringilla ex vitae, auctor pharetra sapien. Nam augue sem, porttitor at mollis sit amet, blandit condimentum diam. Duis ultrices dolor cursus, posuere urna vel, malesuada justo.
                    </td>
                    <td class="py-4 px-6"><a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Link</a></td>
                    <td class="py-4 px-6">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </td>
                    <td class="py-4 px-6">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </td>
                    <td class="py-4 px-6">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </td>
                    <td class="py-4 px-6">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </td>
                    <td class="py-4 px-6">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </td>
                    <td class="py-4 px-6">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </td>
                    <td class="py-4 px-6">
                        0000000000000
                    </td>
                    <td class="py-4 px-6">
                        @RArara
                    </td>
                    <td class="py-4 px-6">
                        <select name="isLulus" id="" class="block w-40 text-lg border-2 rounded p-2 mx-4">
                            <option value="true">Lulus</option>
                            <option value="false">Gagal</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@stop