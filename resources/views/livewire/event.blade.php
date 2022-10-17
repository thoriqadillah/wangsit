<div class="py-20 px-8">
    <div>
        <h1 class="text-mainColor text-3xl text-center lg:text-left">KBMSI Events</h1>
        <div class="flex mt-3 gap-5 overflow-x-auto customScroll pb-8">
            <button wire:click="showEvents()" class="px-8 focus:bg-gray-100 hover:bg-gray-100 text-center shadow-md py-1 border rounded-full border-mainColor">Active</button>
            <button wire:click="showEvents()" class="px-8 focus:bg-gray-100 hover:bg-gray-100 text-center shadow-md py-1 border rounded-full border-mainColor">All</button>
            @foreach ($departements as $departement)
            <button wire:click="showEvents({{ $departement->id }})" class="px-8 focus:bg-gray-100 hover:bg-gray-100 text-center shadow-md py-1 border rounded-full border-mainColor">{{ $departement->nama }}</button>
            @endforeach
        </div>

        <select name="filterPengumuman" wire:model="filter" class="text-lg border-2 border-mainColor bg-white rounded-md py-2 px-4 outline-mainColor">
            <option selected value="aktif">Pendaftaran</option>
            <option value="pengumuman">Pengumuman</option>
        </select>
    </div>

    <div class="grid grid-col-1 lg:grid-cols-3 2xl:grid-cols-4 sm:grid-cols-2 mt-8 gap-x-4 gap-y-10 justify-items-center">
        @foreach ($events as $event)

        <div class="w-80 h-96 sm:w-[300px] xl:w-80 shadow">
            <div class="w-full h-52">
                <img src="{{ $event->thumbnail }}" class="w-full h-full object-cover" />
            </div>

            <div class="p-4 h-40 flex flex-col justify-between">
                <div>
                    <h1 class="text-lg font-medium text-mainColor truncate">{{ $event->nama }}</h1>
                    <p class="text-sm text-gray-400">Berakhir pada {{ $event->tgl_tutup_pendaftaran->format('j F Y') }}</p>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">DAFTAR</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>