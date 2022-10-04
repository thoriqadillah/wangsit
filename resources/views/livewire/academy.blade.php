<div class="px-8 lg:px-20 py-20 lg:py-28">
    <div>
        <h1 class="font-bold text-center text-mainColor text-2xl">WANGSIT Academy</h1>
        <form class="relative">
            <img src="{{url('/asset/Search.svg')}}" alt="seacrh" class="absolute w-5 top-3 left-4 lg:left-[405px]">
            <input wire:model.debounce.500ms="search" id="searchAcademy" type="text" class="block mx-auto lg:w-[600px] w-full mt-4 lg:mt-10 rounded-full outline-mainColor border shadow py-2 pl-12 pr-4 lg:pl-16" placeholder="search" />
        </form>
    </div>

    <div class="grid grid-col-1 lg:grid-cols-3 md:grid-cols-2 mt-8 gap-8 lg:gap-10 lg:px-20">
        @foreach ($academies as $academy)
            <div class="w-full shadow-xl modul">
                <div class="w-full h-60">
                    <img src="{{url('/asset/thumbnail2.png')}}" class="w-full h-full object-cover" />
                </div>
                <div class="p-4">
                    <div>
                        <h1 class="text-lg text-mainColor text-center">{{ $academy->nama }}</h1>
                    </div>
                    <a href="{{ $academy->link }}" target="_blank" class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">BUKA</a>
                </div>
            </div>
        @endforeach
    </div>
</div>