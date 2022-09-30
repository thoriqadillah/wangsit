@extends('layouts.layouts')
@section('content')
<div class="px-8 lg:px-20 py-20 lg:py-28">
    <h1 class="text-mainColor text-3xl text-center lg:text-left">KBMSI Events</h1>

    <div class="flex mt-3 gap-5 overflow-x-auto hideScroll">
        <a href="event/active" class="px-8 text-center shadow-md py-1 border rounded-full border-mainColor">Active</a>
        <a href="event/all" class="px-8 text-center shadow-md py-1 border rounded-full border-mainColor">All
        </a>
        <a href="event/nondept" class="px-8 text-center shadow-md py-1 border rounded-full border-mainColor">NONDEPT
        </a>
        <a href="event/medkominfo" class="px-8 text-center shadow-md py-1 border rounded-full border-mainColor">MEDKOMINFO
        </a>
        <a href="event/advokesma" class="px-8 text-center shadow-md py-1 border rounded-full border-mainColor">ADVOKESMA
        </a>
        <a href="event/psdm" class="px-8 text-center shadow-md py-1 border rounded-full border-mainColor">PSDM
        </a>
        <a href="event/p2s" class="px-8 text-center shadow-md py-1 border rounded-full border-mainColor">P2S
        </a>
        <a href="event/kwu" class="px-8 text-center shadow-md py-1 border rounded-full border-mainColor">KWU
        </a>
        <a href="event/sosma" class="px-8 text-center shadow-md py-1 border rounded-full border-mainColor">SOSMA
        </a>
    </div>

    <div class="grid grid-col-1 lg:grid-cols-4 mt-8 gap-8">
        <div class="w-full shadow-xl">
            <div class="w-full h-60">
                <img src="{{url('/asset/thumbnail1.png')}}" class="w-full h-full object-cover" />
            </div>
            <div class="p-4">
                <div>
                    <h1 class="text-lg text-mainColor">STARSHIP 2021</h1>
                    <p class="font-thin text-sm text-gray-400">20/10/2022</p>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>

        <div class="w-full shadow-xl">
            <div class="w-full h-60">
                <img src="{{url('/asset/thumbnail1.png')}}" class="w-full h-full object-cover" />
            </div>
            <div class="p-4">
                <div>
                    <h1 class="text-lg text-mainColor">STARSHIP 2021</h1>
                    <p class="font-thin text-sm text-gray-400">20/10/2022</p>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>

        <div class="w-full shadow-xl">
            <div class="w-full h-60">
                <img src="{{url('/asset/thumbnail1.png')}}" class="w-full h-full object-cover" />
            </div>
            <div class="p-4">
                <div>
                    <h1 class="text-lg text-mainColor">STARSHIP 2021</h1>
                    <p class="font-thin text-sm text-gray-400">20/10/2022</p>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>

        <div class="w-full shadow-xl">
            <div class="w-full h-60">
                <img src="{{url('/asset/thumbnail1.png')}}" class="w-full h-full object-cover" />
            </div>
            <div class="p-4">
                <div>
                    <h1 class="text-lg text-mainColor">STARSHIP 2021</h1>
                    <p class="font-thin text-sm text-gray-400">20/10/2022</p>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>

        <div class="w-full shadow-xl">
            <div class="w-full h-60">
                <img src="{{url('/asset/thumbnail1.png')}}" class="w-full h-full object-cover" />
            </div>
            <div class="p-4">
                <div>
                    <h1 class="text-lg text-mainColor">STARSHIP 2021</h1>
                    <p class="font-thin text-sm text-gray-400">20/10/2022</p>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>

        <div class="w-full shadow-xl">
            <div class="w-full h-60">
                <img src="{{url('/asset/thumbnail1.png')}}" class="w-full h-full object-cover" />
            </div>
            <div class="p-4">
                <div>
                    <h1 class="text-lg text-mainColor">STARSHIP 2021</h1>
                    <p class="font-thin text-sm text-gray-400">20/10/2022</p>
                </div>
                <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
            </div>
        </div>
    </div>
</div>
@stop