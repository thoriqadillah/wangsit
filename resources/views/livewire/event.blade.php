<div class="">
    <div>
        <h1 class="text-mainColor text-3xl text-center lg:text-left">KBMSI Events</h1>
        <div class="flex mt-3 gap-5 overflow-x-auto hideScroll">
            <button wire:click="showEvents()" class="px-8 focus:bg-gray-100 hover:bg-gray-100 text-center shadow-md py-1 border rounded-full border-mainColor">Active</button>
            <button wire:click="showEvents()" class="px-8 focus:bg-gray-100 hover:bg-gray-100 text-center shadow-md py-1 border rounded-full border-mainColor">All</button>
            @foreach ($departements as $departement)
            <button wire:click="showEvents({{ $departement->id }})" class="px-8 focus:bg-gray-100 hover:bg-gray-100 text-center shadow-md py-1 border rounded-full border-mainColor">{{ $departement->nama }}</button>
            @endforeach
        </div>
    </div>

    <div class="grid grid-col-1 lg:grid-cols-4 md:grid-cols-3 mt-8 gap-8">
        @foreach ($events as $event)
        <div class="w-full shadow-xl">
            <div class="w-full h-60">
                <img src="{{ $event->thumbnail }}" class="w-full h-full object-cover" />
            </div>
            <div class="p-4">
                <div>
                    <h1 class="text-lg text-mainColor">{{ $event->nama }}</h1>
                    <p class="font-thin text-sm text-gray-400">Berakhir pada {{ $event->tgl_tutup_pendaftaran->format('j F Y') }}</p>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>

        <div class="w-full px-4 pb-2">
            <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
        </div>
    </div>
    @endforeach
</div>
</div>