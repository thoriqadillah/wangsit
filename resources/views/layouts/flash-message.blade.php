@if ($message = Session::get('error'))
<div onclick="closeAlert()" class="alert absolute left-[40%] z-20 w-1/4 flex flex-row items-center bg-red-200 p-5 rounded border-b-2 border-red-300">
  <div class="alert-content ml-4">
    <div class="alert-title font-semibold text-lg text-red-800">
      Error
    </div>
    <div class="alert-description text-sm text-red-600">
      {{ $message }}
    </div>
  </div>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span class="text-xl" aria-hidden="true">&times;</span>
  </button>
</div>
@endif


@if ($message = Session::get('success'))
<div onclick="closeAlert()" class="alert absolute left-[40%] z-20 w-1/4 flex flex-row justify-between items-center bg-green-200 p-5 rounded">
  <div class="alert-content ml-4">
    <div class="alert-title font-semibold text-lg text-green-800">
      Success
    </div>
    <div class="alert-description text-sm text-green-600">
      {{ $message }}
    </div>
  </div>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span class="text-xl" aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if ($message = Session::get('warning'))
<div onclick="closeAlert()" class="alert absolute left-[40%] z-20 w-1/4 flex flex-row items-center bg-yellow-200 p-5 rounded border-b-2 border-yellow-300">
  <div class="alert-content ml-4">
    <div class="alert-title font-semibold text-lg text-yellow-800">
      Warning
    </div>
    <div class="alert-description text-sm text-yellow-600">
      {{ $message }}
    </div>
  </div>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span class="text-xl" aria-hidden="true">&times;</span>
  </button>
</div>
@endif

@if ($message = Session::get('info'))
<div onclick="closeAlert()" class="alert absolute left-[40%] z-20 w-1/4 flex flex-row items-center bg-blue-200 p-5 rounded border-b-2 border-blue-300">
  <div class="alert-content ml-4">
    <div class="alert-title font-semibold text-lg text-blue-800">
      Info
    </div>
    <div class="alert-description text-sm text-blue-600">
      {{ $message }}
    </div>
  </div>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span class="text-xl" aria-hidden="true">&times;</span>
  </button>
</div>
@endif