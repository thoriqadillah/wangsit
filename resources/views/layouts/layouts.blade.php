<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')

</head>

<body>
    <nav class="w-full flex h-16 px-5 lg:px-16 items-center bg-white shadow fixed justify-between">
        <img src="{{url('/asset/menu.svg')}}" class="w-6 lg:hidden" />
        <img src="{{url('/asset/logo.png')}}" class="w-24 lg:w-32" />
        <div class="hidden lg:flex items-center gap-8 text-xl text-mainColor">
            <a href="/event">Event</a>
            <a href="/academy">Academy</a>
            <a href="/logout" class="flex items-center gap-2">
                <h1>Logout </h1>
                <img src="{{url('/asset/logout.svg')}}" class="w-4" />
            </a>
        </div>
    </nav>
    @yield('content')

    <script src="{{url('/script/script.js')}}"></script>
</body>

</html>