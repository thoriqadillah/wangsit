<div class="py-20 px-4 sm:px-8 lg:px-16">
    <div>
        <h1 class="text-mainColor text-3xl text-center lg:text-left">KBMSI Events</h1>
        <div class="flex mt-3 gap-5 overflow-x-auto customScroll pb-8">
            <button wire:click="setDept()" class="px-8 focus:bg-gray-100 hover:bg-gray-100 text-center shadow-md py-1 border rounded-full border-mainColor">Active</button>
            <button wire:click="setDept()" class="px-8 focus:bg-gray-100 hover:bg-gray-100 text-center shadow-md py-1 border rounded-full border-mainColor">All</button>
            @foreach ($departements as $departement)
            <button wire:click="setDept({{ $departement->id }})" class="px-8 focus:bg-gray-100 hover:bg-gray-100 text-center shadow-md py-1 border rounded-full border-mainColor">{{ $departement->nama }}</button>
            @endforeach
        </div>

        <div class="flex justify-between items-center">
            <select wire:model="filter" class="text-lg border-2 mt-8 bg-white rounded-md py-2 px-4 outline-mainColor">
                <option value="aktif">Pendaftaran</option>
                <option value="pengumuman">Pengumuman</option>
            </select>
        </div>
    </div>

    <div class="grid grid-col-1 lg:grid-cols-3 2xl:grid-cols-4 sm:grid-cols-2 mt-8 gap-x-8 gap-y-10 justify-items-center">
        @foreach ($events as $event)
        @if ($event->form != null)
        <div class="w-80 h-96 sm:w-full md:w-[360px] lg:w-full shadow">
            <div class="w-full h-52">
                <img src="{{ Storage::url($event->thumbnail) }}" class="w-full h-full object-cover" />
            </div>

            <div class="h-20 px-4 overflow-hidden">
                <h1 class="text-lg font-medium text-mainColor">{{ $event->nama }} </h1>
            </div>
            <div class="px-4">
                <p class="text-sm text-gray-400">Berakhir pada {{ $event->tgl_tutup_pendaftaran->format('j F Y') }}</p>
                <a href="/event/{{ $event->slug }}/daftar{{ $filter === 'aktif' ? '' : '/pengumuman' }}" class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-4">{{ $filter === 'aktif' ? 'DAFTAR' : 'PENGUMUMAN' }}</a>
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

        {{ $events->currentPage()}}
        
        @if ($events->hasMorePages())
        <img wire:click="nextPage" wire:loading.attr="disabled" src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
        @endif
    </div>
    @endif
</div>