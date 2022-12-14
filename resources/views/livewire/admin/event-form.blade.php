<div class="py-20 mx-auto">
    <div class="w-[800px] mx-auto">
        @include('layouts.flash-message')
        <h1 class=" text-2xl font-medium">Form {{ $event->nama }}</h1>

        @foreach ($forms as $i => $form)
            <div class="w-full border rounded shadow bg-white p-8 mt-8">
                <label class="block mb-2 text-gray-900">Jenis Form</label>
                <select wire:model="forms.{{$i}}.form_type" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg outline-none py-2 px-3 w-80">
                    <option value="Text">Text</option>
                    <option value="Textarea">Textarea</option>
                    <option value="Checkbox">Checkbox</option>
                    <option value="Radio">Radio</option>
                    <option value="Dropdown">Dropdown</option>
                </select>

                <div class="flex gap-8 mt-6">
                    <div class="w-full">
                        <label>Judul</label>
                        <input type="text"  wire:model.defer="forms.{{$i}}.judul"  class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                        @error("forms.$i.judul")
                            <span class="text-newRed mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($forms[$i]['form_type'] == "Text" || $forms[$i]['form_type'] == "Textarea") 
                        <div class="w-full">
                            <label>Placeholder</label>
                            <input type="text" wire:model.defer="forms.{{$i}}.placeholder" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                            @error("forms.$i.placeholder")
                                <span class="text-newRed mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>

                @if ($forms[$i]['form_type'] != "Text" && $forms[$i]['form_type'] != "Textarea") 
                    @foreach ($forms[$i]['options'] as $j => $options)
                        <div class="rounded bg-white shadow border p-8 mt-6 mx-3 relative">
                            <img wire:click="deleteInputOption({{ $i }}, {{ $j }})" src="{{url('/asset/icons/close.svg')}}" alt="" class="absolute cursor-pointer -top-3 -right-4">

                            <h1 class="font-bold">Opsi Pilihan {{ $j+1 }}</h1>
                            <div class="flex gap-8 mt-4">
                                <div class="w-full">
                                    <label>Judul Opsi</label>
                                    <input type="text" wire:model.lazy="forms.{{$i}}.options.{{$j}}" class="w-full border border-gray-400 rounded bg-white py-1 px-3 mt-3 outline-mainColor">
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="flex gap-4 mt-4 ml-3 w-40">
                        <button wire:click="addInputOption({{ $i }})" class="border border-mainColor text-mainColor rounded bg-white grow py-2">Tambah Opsi</button>
                    </div>
                @endif

                <div class="flex items-center mt-6 gap-2">
                    <input id="checked-checkbox" wire:model="forms.{{$i}}.required" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500" {{ $forms[$i]["required"] ? 'checked' : '' }}>
                    <label for="checked-checkbox" class="ml-2 font-medium text-gray-900">Wajib diisi</label>
                </div>

                <div class="flex gap-4 mt-6 w-80">
                    <button wire:click="addInput({{ $i+1 }})" class="border border-mainColor text-mainColor rounded bg-white grow py-2">Tambah Input</button>
                    <button wire:click="deleteInput({{ $i }})" class="border border-newRed text-newRed rounded bg-white grow py-2">Hapus Input</button>
                </div>
            </div>
        @endforeach
        <div class="flex gap-4 mt-6 w-80">
            @if ($isUpdate)
                <button wire:click="updateForm()" class="border text-white rounded bg-mainColor grow py-2 mb-2">Simpan</button>
            @else
                <button wire:click="createForm()" class="border text-white rounded bg-mainColor grow py-2 mb-2">Simpan</button>
            @endif
        </div>
    </div>
</div>
