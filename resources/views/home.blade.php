@extends('layouts.app')
@section('content')
<div class="flex flex-col lg:flex-row gap-5 px-4 py-20 lg:py-28">

    <div class="flex flex-col gap-5 grow">
        <!-- Apps Section -->
        <div class="w-full border border-mainColor rounded flex flex-col gap-5">
            <div class="w-full h-16 text-white rounded-t bg-mainColor flex items-center justify-center text-lg">
                Apps
            </div>

            <div class="flex flex-col sm:flex-row lg:justify-evenly ">
                <div class="w-full px-3 rounded">
                    <img src="{{url('/asset/e-complaint.png')}}" class="block mx-auto" />
                </div>

                <div class="w-full px-3 rounded">
                    <img src="{{url('/asset/website-kbmsi.png')}}" class="block mx-auto" />
                </div>

                <div class="w-full px-3 rounded mb-8">
                    <img src="{{url('/asset/wakanda.png')}}" class="block mx-auto" />
                </div>
            </div>
        </div>
        <!-- Apps Section -->


        <!-- Event Section -->
        <div class="w-full">
            <h1 class="text-mainColor text-2xl text-center font-bold mt-10">Current KBMSI Events</h1>
            <div class="grid grid-col-1 md:grid-cols-2 w-full xl:grid-cols-3 mt-8 gap-8 justify-items-center">
                <div class="w-80 h-96 shadow">
                    <div class="w-full h-52">
                        <img src="{{url('/asset/thumbnail1.png')}}" class="w-full h-full object-cover" />
                    </div>

                    <div class="p-4 h-40 flex flex-col justify-between">
                        <div>
                            <h1 class="text-lg font-medium text-mainColor">STARSHIP 2021</h1>
                            <p class="text-sm text-gray-400">End: 20/10/2022</p>
                        </div>
                        <button class="block w-full rounded-md shadow-md bg-mainColor text-center text-white py-3 mt-6">REGISTER</button>
                    </div>
                </div>

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
                        <img src="https://siakad.ub.ac.id/dirfoto/foto/foto_2019/195150401111026.jpg" class="w-full h-full rounded-full object-cover">
                    </div>
                    <div class="text-center">
                        <h1 class="text-xl mb-2">Nama Lengkap</h1>
                        <p class="text-sm">195150401111026</p>
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
                <div class="flex gap-x-3 items-center">
                    <div class="w-12 h-12">
                        <!-- ganti dengan image -->
                        <img src="https://siakad.ub.ac.id/dirfoto/foto/foto_2019/195150401111026.jpg" class="w-full h-full rounded-full object-cover">

                    </div>
                    <div>
                        <h1>Abdurrizqo Arrahman</h1>
                        <p class="text-sm text-gray-400">2022-09-16</p>
                    </div>
                </div>

                <div class="flex gap-x-3 items-center">
                    <div class="w-12 h-12">
                        <!-- ganti dengan image -->
                        <img src="https://siakad.ub.ac.id/dirfoto/foto/foto_2019/195150401111026.jpg" class="w-full h-full rounded-full object-cover">

                    </div>
                    <div>
                        <h1>Abdurrizqo Arrahman</h1>
                        <p class="text-sm text-gray-400">2022-09-16</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Birthday Section-->
    </div>
</div>
@stop