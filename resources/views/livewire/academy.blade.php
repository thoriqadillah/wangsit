<div class=" px-4 py-20">
    <div>
        <h1 class="font-bold text-center text-mainColor text-2xl">WANGSIT Academy</h1>
        <form class="relative mx-auto lg:w-[600px] w-full mt-4 lg:mt-10">
            <img src="{{url('/asset/Search.svg')}}" alt="seacrh" class="absolute w-5 left-[4%] top-3">
            <input wire:model.debounce.500ms="search" type="text" class="block w-full rounded-full outline-mainColor border shadow py-2 pl-12 sm:pl-[10%] pr-4" placeholder="search" />
        </form>
    </div>

    <div class="grid grid-col-1 lg:grid-cols-3 xl:grid-cols-4 sm:grid-cols-2 mt-16 gap-8 justify-items-center">
        @foreach ($academies as $academy)
        <div class="w-80 h-80 bg-white border rounded shadow">
            <div>
                <img src="{{url('/asset/thumbnail2.png')}}" class="w-40 h-40 object-cover block mx-auto" />

                <div class="px-4 w-full pt-2">
                    <h1 class="text-lg uppercase truncate text-center">{{ $academy->nama }}</h1>
                </div>
            </div>

            <div class="p-4 w-full">
                <a href="{{ $academy->link }}" target="_blank" class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-4">BUKA</a>
            </div>
        </div>
        @endforeach
    </div>
</div>