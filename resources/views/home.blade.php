@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row gap-5 px-4 md:px-8 lg:px-12 xl:px-20 py-20 lg:py-28">

    <div class="flex flex-col gap-5 grow">
        <!-- Apps Section -->
        <div class="w-full border border-mainColor rounded flex flex-col gap-5 pb-8">
            <div class="w-full h-16 text-white rounded-t bg-mainColor flex items-center justify-center text-lg">
                Apps
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 mx-4 gap-5 justify-items-center">
                <a href="https://ecomplaint.kbmsi.or.id/" class="shadow-md w-60 sm:w-full border rounded lg:w-48 xl:w-60">
                    <img src="{{url('/asset/icons/e-complaint.png')}}" class="rounded w-full h-full object-cover" />
                </a>

                <a href="http://kbmsi.filkom.ub.ac.id/" class="shadow-md w-60 sm:w-full rounded lg:w-48 xl:w-60">
                    <img src="{{url('/asset/icons/website-kbmsi.png')}}" class="rounded w-full h-full object-cover" />
                </a>

                <a href="https://wowsi.kbmsi.or.id/" class="shadow-md w-60 sm:w-full rounded lg:w-48 xl:w-60">
                    <img src="{{url('/asset/icons/wowsi.png')}}" class="rounded w-full h-full object-cover" />
                </a>
            </div>
        </div>
        <!-- Apps Section -->


        <!-- Event Section -->
        <div class="w-full">
            <h1 class="text-mainColor text-2xl text-center font-bold mt-10">Current KBMSI Events</h1>
            <div class="grid grid-col-1 md:grid-cols-2 xl:grid-cols-3 w-full mt-8 gap-8 justify-items-center">
                @foreach ($latestEvent as $event)
                <div class="w-80 md:w-[340px] lg:w-full h-96 shadow">
                    <div class="w-full h-52">
                        <img src="{{ $event->thumbnail }}" class="w-full h-full object-cover" />
                    </div>

                    <div class="p-4 h-40 flex flex-col justify-between">
                        <div>
                            <h1 class="text-lg font-medium text-mainColor truncate">{{ $event->nama }}</h1>
                            <p class="text-sm text-gray-400">Berakhir {{ $event->countdown }} hari lagi</p>
                        </div>
                        <a href="/event/{{ $event->slug }}/daftar" class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">DAFTAR</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Event Section -->

    </div>


    <div class="flex flex-col gap-5 lg:w-[400px]">
        <!-- Profile Section -->
        <div class="w-80 sm:w-96 lg:w-full mx-auto border border-mainColor rounded mt-20 lg:mt-0">
            <div class="w-full h-24 bg-mainColor rounded-t"></div>
            <div class="w-full h-44 bg-white rounded-b relative">
                <div class="absolute px-5 -top-12 w-full">
                    <div class="rounded-full h-28 w-28 mx-auto mb-2">
                        <img src="{{ $user->profile_pic }}" class="w-full h-full rounded-full object-cover">
                    </div>
                    <div class="text-center">
                        <h1 class="text-xl mb-2">{{ $user->nama }}</h1>
                        <p class="text-sm">{{ $user->nim }}</p>
                    </div>
                </div>
            </div>

        </div>
        <!-- Profile Section -->


        <!-- Birthday Section-->
        <div class="w-80 sm:w-96 lg:w-full mx-auto  border border-mainColor rounded">
            <div class="w-full h-16 text-white rounded-t bg-mainColor flex items-center justify-center text-lg mb-5">
                Happy Birthday!
            </div>
            <div class="grid grid-cols-1 gap-y-4 px-3 pb-8">
                @foreach ($birthdayUsers as $userr)
                <div class="flex gap-x-3 items-center">
                    <div class="w-12 h-12">
                        <img src="{{ $userr->profile_pic }}" class="w-full h-full rounded-full object-cover">
                    </div>
                    <div>
                        <h1>{{ $userr->nama }}</h1>
                        <p class="text-sm text-gray-400">{{ $userr->tgl_lahir }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Birthday Section-->
    </div>
</div>
@stop