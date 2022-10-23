@extends('layouts.app')
@section('content')


<div class="pt-20 px-10">
    <h1 class=" text-2xl font-medium"> Event Starship</h1>

    <div class="flex justify-between items-center">
        <div class="flex items-center gap-8">
            <a href="" class="py-2 rounded-full bg-white border border-mainColor text-mainColor mt-8 block w-40 text-center">Add Academy</a>
            <a href="" class="py-2 rounded-full bg-white border border-mainColor text-mainColor mt-8 block w-40 text-center">Preview Form</a>
        </div>

        <div class="flex gap-4 items-center">
            <img src="{{url('/asset/icons/kiri.svg')}}" alt="" class="w-10 cursor-pointer">
            <img src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
        </div>
    </div>


    <div class="w-full relative border overflow-y-auto mt-12 mb-20 customScroll">
        <table class="w-full text-sm text-left text-gray-500 border-collapse">
            <thead class="text-xs text-black uppercase bg-blue-100 text-center">
                <tr>
                    @for($j=0;$j<count($response[0]->response);$j++)
                    <th scope="col" class="py-3 px-6">
                        {{ $response[0]->response[$j]['judul'] }}
                    </th>
                    @endfor
                </tr>
            </thead>
            <tbody>                  
                @foreach($response as $resp) 
                <tr class="bg-black border-b align-top">
                    @for($j=0;$j<count($response[0]->response);$j++)
                    <td scope="row" class="p-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $resp->response[$j]['response'] }}                    </td>
                    @endfor
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@stop