<div class="px-8 lg:px-20 py-20 lg:py-28">
  @foreach ($eventForm->format as $index => $form)
    <div class="py-2">
      <label><strong>LABEL</strong> {{ $form['judul'] }}</label>
      <input type="text" wire:model.defer="formResponse.{{$index}}.response" class="border p-3">
      @error("formResponse.$index.response")
          <span class="alert alert-danger">{{ $message }}</span> <!-- buat nampilin error -->
      @enderror
    </div>
  @endforeach

  <button type="button" wire:click="saveResponse()" class="p-2 border bg-gray-200">SAVE</button>
</div>
