@extends('layouts.app')
@section('content')


<div class="pt-20 px-10">
    <h1 class=" text-2xl font-medium"> Event Starship</h1>

    <div class="flex justify-between items-center">
        <div class="flex items-center gap-8">
            <a href="" class="py-2 rounded-full bg-white border border-mainColor text-mainColor mt-8 block w-40 text-center">Add Academy</a>
            <a href="" class="py-2 rounded-full bg-white border border-mainColor text-mainColor mt-8 block w-40 text-center">Preview Form</a>
        </div>
    </div>

    <form>
        <div class="w-full relative border overflow-y-auto mt-12 mb-20 customScroll">
            <table class="w-full text-sm text-left text-gray-500 border-collapse">
                <thead class="text-xs text-black uppercase bg-blue-100 text-center">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            <div class="flex items-center mb-4">
                                <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900">Lulus Semua</label>
                            </div>
                        </th>
                        @for($j=0;$j<count($head->format);$j++)
                            <th scope="col" class="py-3 px-6">
                                {{-- {{ $response[0]->response[$j]['judul'] }} --}}
                                {{ $head->format[$j]['judul'] }}
                            </th>
                            @endfor
                    </tr>
                </thead>
                <tbody>
                    @foreach($response as $resp)
                    <tr class="border-b align-top">
                        <td scope="row" class="p-4 font-medium text-gray-900 whitespace-nowrap">
                            <div class="flex items-center mb-4">
                                <input id="default-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 ">Lulus</label>
                            </div>
                        </td>
                        @for($j=0;$j<count($response[0]->response);$j++)
                            <td scope="row" class="p-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $resp->response[$j]['response'] }}
                            </td>
                        @endfor
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex justify-end mb-20">
            <input class="bg-mainColor text-white rounded-full shadow py-2 px-4" type="submit" value="Luluskan semua yang ditandai">
        </div>
    </form>
    {{--
    <div class="flex gap-4 items-center justify-center my-4">
        <img src="{{url('/asset/icons/kiri.svg')}}" alt="" class="w-10 cursor-pointer">
        <img src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
    </div>
    --}}
</div>
@stop