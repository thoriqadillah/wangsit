<div class="pt-20 px-20">
    @include('layouts.flash-message')
    <div class="flex justify-between items-center mt-8">
        @if ($toAdd)
        <div>
            <div class="flex gap-4">
                <input wire:model.debounce.500ms="search" type="text" placeholder="NIM atau Nama" class="w-80 border px-3 py-2 rounded-full shadow">
                <input type="submit" value="Search" class="px-3 py-1 rounded-full bg-mainColor cursor-pointer text-white">
            </div>
        </div>
        <div>
            <button wire:click="isAdding()" class="border border-mainColor rounded-full bg-mainColor w-40 py-2 text-white">Batal</button>
        </div>
        @else
        <div>
            <button wire:click="isAdding()" class="border border-mainColor rounded-full bg-mainColor w-40 py-2 text-white">Tambah Admin</button>
        </div>
        @endif
    </div>

    <div class="overflow-x-auto relative pt-8">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        No
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Nama Mahasiswa
                    </th>
                    <th scope="col" class="py-3 px-6">
                        NIM
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        Level
                    </th>
                    <th scope="col" class="py-3 px-6 text-center">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($toAdd && $search != '')
                <tr class="bg-blue-50 border-b">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        
                    </th>
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        {{ $searchedUser->nama ?? ' ' }}
                    </th>
                    <td class="py-4 px-6">
                        {{ $searchedUser->nim ?? ' ' }}
                    </td>
                    <td class="py-4">
                        <select wire:model="selectedDept" class="bg-gray-50 blox mx-auto border border-gray-300 w-60 py-4 px-3 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
                            @if ($searchedUser)
                            @foreach ($departements as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->nama }}</option>
                            @endforeach 
                            @endif
                        </select>
                    </td>
                    <td class="py-4">
                        @if ($searchedUser)
                        <button wire:click="setAdmin()" class="rounded-full bg-mainColor text-white px-4 py-2 mx-auto block">Simpan</button>
                        @endif
                    </td>
                </tr>
                @endif
                @if ($admins->onFirstPage())
                <tr class="bg-white border-b">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        1
                    </th>
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        KEMSI
                    </th>
                    <td class="py-4 px-6">
                        0000000000kbmsi
                    </td>
                    <td class="py-4">
                        <h1 class="mx-auto w-60 py-4 px-3 text-gray-900 text-sm text-center block">
                            KEMSI
                        </h1>
                    </td>
                    <td class="py-4">
                        
                    </td>
                </tr>
                @endif
                @foreach ($admins as $i => $user)
                <tr class="bg-white border-b">
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        {{ $admins->onFirstPage() ? $i+2 : $i + $perPage + 2 }}
                    </th>
                    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                        {{ $user->nama }}
                    </th>
                    <td class="py-4 px-6">
                        {{ $user->nim }}
                    </td>
                    <td scope="row" class="mx-auto w-60 py-4 px-3 text-gray-900 text-sm text-center block">
                        {{ $departements[$user->admin->departement_id - 1]->nama }}
                    </td>
                    <td class="py-4">
                        <button title="Hapus admin" wire:click="deleteAdmin({{ $user->id }})" class="rounded-full border border-red-500 bg-red-500 text-white px-4 py-2 mx-auto block">X</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    @if ($admins->hasPages())
    <div class="flex gap-4 items-center justify-center my-4">
        <img wire:click="previousPage" wire:loading.attr="disabled" src="{{url('/asset/icons/kiri.svg')}}" alt="" class="w-10 cursor-pointer">
        {{ $admins->currentPage() }}
        <img wire:click="nextPage" wire:loading.attr="disabled" src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
    </div>
    @endif

</div>