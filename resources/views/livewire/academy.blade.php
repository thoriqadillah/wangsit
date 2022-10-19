<div class="px-4 sm:px-8 lg:px-12 py-24">
    <div>
        <h1 class="font-medium text-center text-mainColor text-2xl">WANGSIT Academy</h1>
        <form class="relative mx-auto lg:w-[600px] w-full mt-4 lg:mt-8">
            <img src="{{url('/asset/icons/Search.svg')}}" alt="seacrh" class="absolute w-5 left-[4%] top-3">
            <input wire:model.debounce.500ms="search" type="text" class="block w-full rounded-full outline-mainColor border shadow py-2 pl-12 sm:pl-[10%] pr-4" placeholder="search" />
        </form>

        <div class="flex justify-between items-center mt-8">
            <div></div>

            <div class="flex gap-4 items-center">
                <img src="{{url('/asset/icons/kiri.svg')}}" alt="" class="w-10 cursor-pointer">
                <img src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
            </div>
        </div>
    </div>

    <div class="grid grid-col-1 lg:grid-cols-3 2xl:grid-cols-4 sm:grid-cols-2 mt-10 gap-x-8 gap-y-10 justify-items-center">
        @foreach ($academies as $academy)
        <div class="w-80 sm:w-full md:w-[360px] lg:w-full h-80 bg-white border rounded shadow">
            <div>
                <img src="{{url('/asset/icons/thumbnail2.png')}}" class="w-40 h-40 object-cover block mx-auto" />

                <div class="px-4 w-full pt-2">
                    <h1 class="text-lg uppercase truncate text-center">{{ $academy->nama }}</h1>
                </div>
            </div>

            <div class="p-4 lg:p-6 w-full">
                <a href="{{ $academy->link }}" target="_blank" class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-4">BUKA</a>
            </div>
        </div>
        @endforeach
    </div>
</div>