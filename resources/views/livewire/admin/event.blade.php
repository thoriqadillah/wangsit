<!-- TODO: integrasi dengan livewire -->
<div class="w-52 py-20 text-white px-8 bg-mainColor h-screen fixed">
    <a href="/admin/event" class="text-white text-xl block">Event</a>
    <a href="/admin/academy" class="text-white text-xl mt-8 block ">Academy</a>
</div>

<div class="pt-20 pl-60 pr-8">
    <div class="flex flex-wrap flex-row-reverse justify-between items-end">
        <span class="px-8 text-center py-2 border rounded-full border-mainColor" title="Departement {{ $userDept->nama }}">{{ $userDept->nama }}</span>
        <a href="" class="py-2 rounded-full bg-mainColor text-white mt-8 block w-40 text-center">Tambah Event</a>
    </div>
    <div class="flex justify-between items-center mt-8">
        <div class="flex gap-8 items-center">
            <label for="countries" class="block mb-2 text-gray-900">Filter By</label>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg outline-none py-2 px-3">
                <option selected>Semua Event</option>
                <option value="aktif">Aktif</option>
                <option value="waiting">Menunggu</option>
                <option value="open-register">Buka Pendaftaran</option>
                <option value="pengumuman">Pengumuman</option>
                <option value="tutup">Tutup</option>
            </select>
        </div>
        <div class="flex gap-4 items-center">
            <img src="{{url('/asset/icons/kiri.svg')}}" alt="" class="w-10 cursor-pointer">
            <img src="{{url('/asset/icons/kanan.svg')}}" alt="" class="w-10 cursor-pointer">
        </div>
    </div>

    <div class="mt-8 grid grid-cols-3 gap-8 mb-12">
        <div class="w-full h-96 bg-white border rounded shadow relative p-5">
            <img src="{{url('/asset/icons/close.svg')}}" alt="" class="absolute cursor-pointer -top-3 -right-4" onclick="confirmDelete()">
            <div class="w-full h-52 bg-red-400">
                <img src="{{url('/asset/icons/thumbnail1.png')}}" class="w-full h-full" alt="">
            </div>
            <div class="mt-5 flex flex-col h-28 justify-between">
                <div>
                    <h1 class="font-medium uppercase truncate">Starship 2021</h1>
                    <h1 class="font-medium text-gray-300 text-sm">20/12/2022</h1>
                </div>
                <div class="flex gap-4">
                    <a class="border border-mainColor rounded cursor-pointer grow block text-center text-mainColor py-2 bg-white">Form</a>
                    <a class="border border-white rounded cursor-pointer grow block text-center text-white py-2 bg-mainColor">Detail</a>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="fixed w-full top-0 bottom-0 right-0 left-0 bg-[#000000e1] z-50 transition duration-100 scale-0" id="modalConfirm">
    <div class="rounded bg-white p-10 w-[500px] mx-auto mt-40">
        <h1 class="text-lg font-medium text-center">Hapus Event Ini ?</h1>
        <div class="flex px-6 items-center justify-between gap-8 mt-8">
            <button class="border rounded text-newRed bg-white border-newRed py-1 grow text-center" onclick="confirmDelete()">Cancel</button>
            <a href="" class="border rounded text-white bg-mainColor border-mainColor py-1 grow text-center">Hapus</a>
        </div>
    </div>
</div>