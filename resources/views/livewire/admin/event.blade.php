<div class="pt-24 px-6 lg:px-12">
    <div class="flex justify-between items-center">
        <a href="/admin/event/tambah" class="py-2 rounded-full bg-mainColor text-white text-sm block w-40 text-center">Tambah Event</a>
        <div class="px-8 text-center py-2 border rounded-full border-grey-800 text-sm" title="Departement {{ $userDept->nama }}">{{ $userDept->nama }}</div>
    </div>

    <div class="flex justify-center md:justify-start gap-8 items-center mt-8">
        <label class="block mb-2 text-gray-900">Filter By</label>
        <select wire:model="filter" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg outline-none py-2 px-3">
            <option value="semua">Semua Event</option>
            <option value="aktif">Pendaftaran</option>
            <option value="waiting">Menunggu</option>
            <option value="pengumuman">Pengumuman</option>
            <option value="tutup">Tutup</option>
        </select>
    </div>

    <div class="mt-8 grid grid-cols-1 justify-items-center md:grid-cols-2 xl:grid-cols-3 gap-8 mb-12">
        @foreach ($events as $event)
        <div class="w-full sm:w-80 h-96 lg:w-96 bg-white border rounded shadow relative p-3">
            <img src="{{url('/asset/icons/close.svg')}}" alt="" class="absolute cursor-pointer w-7 h-7 -top-3 -right-4" onclick="confirmDelete()">
            <div class="w-full h-52 bg-red-400">
                <img src="{{ Storage::url($event->thumbnail) }}" class="w-full h-full" alt="">
            </div>
            <div class="mt-5 flex flex-col h-28 justify-between">
                <div>
                    <h1 class="font-medium truncate">{{ $event->nama }}</h1>
                </div>
                <div class="flex gap-4 mt-2">
                    <a class="border border-mainColor rounded cursor-pointer grow block text-center text-mainColor py-2 bg-white" href="/admin/event/{{ $event->slug }}/form">Form</a>
                    <a class="border border-mainColor rounded cursor-pointer grow block text-center text-white py-2 bg-mainColor" href="/admin/event/{{ $event->slug }}">Edit</a>
                </div>
                <div class="flex gap-4 mt-2">
                    <a class="border border-white rounded cursor-pointer grow block text-center text-white py-2 bg-mainColor" href="/admin/detail/event/{{ $event->slug }}/form/response">Pendaftar</a>
                </div>
            </div>
        </div>
        <div class="fixed w-full top-0 bottom-0 right-0 left-0 bg-[#000000e1] z-50 transition duration-100 scale-0" id="modalConfirm">
            <div class="rounded bg-white p-10 w-[500px] mx-auto mt-40">
                <h1 class="text-lg font-medium text-center">Hapus Event Ini ?</h1>
                <div class="flex px-6 items-center justify-between gap-8 mt-8">
                    <button class="border rounded text-newRed bg-white border-newRed py-1 grow text-center" onclick="confirmDelete()">Cancel</button>
                    <a href="/admin/event" wire:click="deleteEvent({{ $event->id }})" class="border rounded text-white bg-mainColor border-mainColor py-1 grow text-center">Hapus</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="flex gap-4 items-center justify-center mb-8">
        <img src="{{url('/asset/icons/kiri.svg')}}" alt="" class="w-10 cursor-pointer">
        <img src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
    </div>
</div>