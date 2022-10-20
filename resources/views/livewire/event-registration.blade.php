<div class="mx-96 py-20">
  <div class="mt-5 bg-white border shadow rounded py-16 px-24">
    <h1 class="text-2xl font-medium text-mainColor mb-12">Form Pendaftaran {{ $event->nama }}</h1>
    @foreach ($eventForm->format as $index => $form)
      <div class="mt-4">
        <label class="block mb-2 text-lg font-medium text-gray-600">{{ $form['judul'] }} <span class="text-newRed">{{ $form['required'] ? '*' : '' }}</span></label>
        <div>
          @if ($form['form_type'] == 'Text')
            <input type="text" wire:model.lazy="formResponse.{{$index}}.response" placeholder="{{ $form['placeholder'] }}" class="w-full border px-3 py-2 bg-gray-50 rounded border-gray-300 outline-none">
          @elseif ($form['form_type'] == 'Textarea')
            <textarea wire:model.lazy="formResponse.{{$index}}.response" placeholder="{{ $form['placeholder'] }}" class="block p-4 h-24 w-full outline-none bg-gray-50 rounded-lg border border-gray-300 resize-none"></textarea>
          @elseif ($form['form_type'] == 'Radio')
            @foreach ($form['value_options'] as $option)
              <div class="flex items-center mb-2">
                <input wire:model.lazy="formResponse.{{$index}}.response" type="radio" value="{{ $option['value'] }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label class="ml-2 text-sm font-medium text-gray-900">{{ $option['text'] }}</label>
              </div>
            @endforeach
          @elseif ($form['form_type'] == 'Dropdown')
            <select wire:model.lazy="formResponse.{{$index}}.response" class="w-full border px-3 py-2 rounded border-gray-300 outline-none">
              <option selected value="" disabled>Pilih salah satu</option>
            @foreach ($form['value_options'] as $option)
              <option value="{{ $option['value'] }}">{{ $option['text'] }}</option>
            @endforeach
            </select>
          @else
            @foreach ($form['value_options'] as $option)
              <div class="flex items-center gap-4 mt-2">
                <input wire:model.lazy="formResponse.{{$index}}.response" type="checkbox" value="{{ $option['value'] }}" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300">{{ $option['text'] }}</label>
              </div>
            @endforeach
          @endif
        </div>
        @error("formResponse.$index.response")
          <span class="text-newRed mt-1">{{ $message }}</span> <!-- buat nampilin error -->
        @enderror
      </div>
    @endforeach
    <div class="flex items-center gap-4 mt-4">
      <input wire:model.lazy="aggrement" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-red-300">
      <label >Dengan ini saya menyetujui seluruh prasyarat yang ada <span class="text-newRed">*</span></label>
    </div>
    <div class="flex items-center gap-4 mt-4">
      <p>(<span class="text-newRed">*</span>) Wajib diisi</p>
    </div>
    <div>
      <button wire:click="saveResponse()" class="mt-4 w-full cursor-pointer rounded bg-mainColor py-2 text-white text-lg">Kirim</button>
    </div>
  </div>
</div>