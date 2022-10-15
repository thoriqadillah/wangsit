<div class="">
    <div class="px-8">
        <h1 class="font-bold text-center text-mainColor text-2xl">WANGSIT Academy</h1>
        <form class="relative">
            <img src="{{url('/asset/Search.svg')}}" alt="seacrh" class="absolute w-5 top-3 left-4 lg:left-[405px]">
            <input wire:model.debounce.500ms="search" type="text" class="block mx-auto lg:w-[600px] w-full mt-4 lg:mt-10 rounded-full outline-mainColor border shadow py-2 pl-12 pr-4 lg:pl-16" placeholder="search" />
        </form>
    </div>

    <div class="grid grid-col-1 xl:grid-cols-4 md:grid-cols-2 mt-8 gap-8 lg:gap-10 justify-items-center w-full">
        @foreach ($academies as $academy)
        <div class="mx-auto shadow border h-80 flex flex-col items-center justify-between w-80">
            <div>
                <img src="{{url('/asset/thumbnail2.png')}}" class="w-40 h-40 object-cover block mx-auto" />

                <div class="px-4 w-full pt-2">
                    <h1 class="text-lg text-mainColor text-center">{{ $academy->nama }}</h1>
                </div>
            </div>

            <div class="p-4 w-full">
                <a href="{{ $academy->link }}" target="_blank" class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-4">BUKA</a>
            </div>
        </div>
        @endforeach
    </div>
</div>