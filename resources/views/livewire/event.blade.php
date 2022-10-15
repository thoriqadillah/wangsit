<div class="py-20 px-4">
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

    <div class="grid grid-col-1 lg:grid-cols-3 xl:grid-cols-4 sm:grid-cols-2 mt-8 gap-8 justify-items-center">
        @foreach ($events as $event)

        <div class="w-80 h-96 shadow">
            <div class="w-full h-52">
                <img src="{{ $event->thumbnail }}" class="w-full h-full object-cover" />
            </div>

            <div class="p-4 h-40 flex flex-col justify-between">
                <div>
                    <h1 class="text-lg font-medium text-mainColor truncate">{{ $event->nama }}</h1>
                    <p class="text-sm text-gray-400">End: {{ $event->tgl_tutup_pendaftaran->format('j F Y') }}</p>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>