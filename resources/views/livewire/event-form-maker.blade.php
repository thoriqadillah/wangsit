<div class="px-8 lg:px-20 py-20 lg:py-28">
  @foreach ($forms as $i => $form)
    <div class="border py-2 my-2">
        <div class="py-2">
            <label><strong>TIPE FORM</strong></label>
            <select name="form_type" wire:model="forms.{{$i}}.form_type_id" data-selector="selector-{{$i}}">
                @foreach ($formTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="py-2">
            <label><strong>JUDUL</strong></label>
            <input type="Text" wire:model.defer="forms.{{$i}}.judul" class="border p-3">
        </div>
        <div class="py-2">
            <label><strong>PLACEHOLDER</strong></label>
            <input type="text" wire:model.defer="forms.{{$i}}.placeholder" class="border p-3">
        </div>
        @if ($forms[$i]['form_type_id'] !== 1) 
            <div class="py-2 border my-2" data-option="option={{$i}}">
                @foreach ($forms[$i]['value_options'] as $j => $options)
                    <label><strong>OPSI PILIHAN {{ $j }}</strong></label>
                    <div>
                        <label><strong>JUDUL OPSI</strong></label>
                        <input type="text" wire:model.defer="forms.{{$i}}.value_options.{{$j}}.text" class="border p-3">
                        <label><strong>VALUE OPSI</strong></label>
                        <input type="text" wire:model.defer="forms.{{$i}}.value_options.{{$j}}.value" class="border p-3">
                        <button type="button" wire:click="addInputOption({{ $i }})" class="p-2 border bg-gray-200">TAMBAH OPSI</button>
                        <button type="button" wire:click="deleteInputOption({{ $i }}, {{ $j }})" class="p-2 border bg-gray-200">HAPUS OPSI</button>
                    </div>
                @endforeach
            </div>
        @endif
        <div>
            <button type="button" wire:click="deleteInput({{ $i }})" class="p-2 border bg-gray-200">HAPUS INPUT</button>
        </div>
    </div>
  @endforeach

  <div>
    <button type="button" wire:click="addInput()" class="p-2 border bg-gray-200">TAMBAH INPUT</button>
  </div>
  <br>
  <div>
    <button type="button" wire:click="createForm()" class="p-2 border bg-gray-200">SAVE</button>
  </div>
</div>
