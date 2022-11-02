<div class="pt-28 py-20 px-4 sm:px-8 lg:px-16 flex-col flex">
    @include('layouts.flash-message')
    <div class="flex flex-wrap flex-row-reverse justify-center sm:justify-between gap-8 items-center">
        <span class="px-8 text-center py-2 border rounded-full border-grey-800" title="Departement {{ $userDept->nama }}">{{ $userDept->nama }}</span>
        <a href="/admin/event/tambah" class="py-2 rounded-full bg-mainColor text-white block w-40 text-center">Tambah Event</a>
    </div>

    <div class="flex justify-center md:justify-start gap-8 items-center mt-8">
        <label class="block mb-2 text-gray-900">Filter By</label>
        <select wire:model="filter" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg outline-none py-2 px-3">
            <option selected value="semua">Semua Event</option>
            <option value="pendaftaran">Pendaftaran</option>
            <option value="waiting">Menunggu</option>
            <option value="pengumuman">Pengumuman</option>
            <option value="tutup">Tutup</option>
        </select>
    </div>

    <div class="mt-8 grid grid-cols-1 justify-items-center md:grid-cols-2 xl:grid-cols-3 gap-8 mb-12">
        @foreach ($events as $i => $event)
        <div class="w-80 h-96 lg:w-96 bg-white border rounded shadow relative p-3">
            <img wire:click="setDeleting({{ $event->id }})" src="{{url('/asset/icons/close.svg')}}" alt="" class="absolute cursor-pointer w-7 h-7 -top-3 -right-4">
            <div class="w-full h-52 bg-gray-300">
                <img src="{{ Storage::url($event->thumbnail) }}" class="w-full h-full" alt="">
            </div>
            <div class="mt-5 flex flex-col h-28 justify-between">
                <div>
                    <h1 class="font-medium truncate">{{ $event->nama }}</h1>
                </div>
                <div class="flex gap-4 mt-2">
                    <a class="border border-mainColor rounded cursor-pointer grow block text-center text-mainColor py-2 bg-white" href="/admin/event/{{ $event->slug }}/form">{{ $event->form == null ? 'Tambah Form' : 'Form' }}</a>
                    <a class="border border-mainColor rounded cursor-pointer grow block text-center text-white py-2 bg-mainColor" href="/admin/event/{{ $event->slug }}">Edit</a>
                </div>
                <div class="flex gap-4 mt-2">
                    @if ($event->form != null)
                    <a class="border border-white rounded cursor-pointer grow block text-center text-white py-2 bg-mainColor" href="/admin/event/{{ $event->slug }}/form/response">Pendaftar</a>
                    @else
                    <a class="border border-white rounded grow block text-center text-white py-4 bg-white"></a>
                    @endif
                </div>
            </div>
        </div>

        @if ($deleting)
        <div class="fixed w-full top-0 bottom-0 right-0 left-0 bg-[#000000e1] {{ $event->id == $selectForDelete ? 'z-50' : 'z-20' }}">
            <div class="rounded bg-white p-10 w-[500px] mx-auto mt-40">
                <h1 class="text-lg font-medium text-center">Hapus Event {{ $event->nama }}?</h1>
                <div class="flex px-6 items-center justify-between gap-8 mt-8">
                    <button wire:click="setDeleting()" class="border rounded text-newRed bg-white border-newRed py-1 grow text-center">Cancel</button>
                    <button wire:click="deleteEvent({{ $event->id }})" class="border rounded text-white bg-mainColor border-mainColor py-1 grow text-center">Hapus</button>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    @if ($events->hasPages())
    <div class="flex gap-4 items-center justify-center my-4">
        @if (!$events->onFirstPage())
        <img wire:click="previousPage" wire:loading.attr="disabled" src="{{url('/asset/icons/kiri.svg')}}" alt="" class="w-10 cursor-pointer">
        @endif

        {{ $events->currentPage() }}

        @if ($events->hasMorePages())
        <img wire:click="nextPage" wire:loading.attr="disabled" src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
        @endif
    </div>
    @endif
</div>