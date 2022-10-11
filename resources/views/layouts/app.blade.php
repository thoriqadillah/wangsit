<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body>
    <!-- untuk 404 -->
    @yield('error') 
    
    @auth
    <nav class="w-full flex h-16 px-5 lg:px-16 items-center bg-white shadow z-20 fixed justify-between">
        <img src="{{url('/asset/menu.svg')}}" class="w-6 lg:hidden" onclick="mySidebar()" />
        <img src="{{url('/asset/logo.png')}}" class="w-24 lg:w-32" />
        <div class="hidden lg:flex items-center gap-8 text-xl text-mainColor">
            <a href="/">
                <div class="hover:after:content-[''] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2">
                    Home
                </div>
            </a>

            <a href="/event">
                <div class="hover:after:content-[''] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2">
                    Event
                </div>
            </a>
            <a href="/academy">
                <div class="hover:after:content-[''] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2">
                    Academy
                </div>
            </a>
            @if (auth()->check() && auth()->user()->admin_id != null)
            <a href="/admin">
                <div class="hover:after:content-[''] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2">
                    Admin
                </div>
            </a>
            @endif
            <a href="/logout">
                <div class="hover:after:content-[''] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative after:transition after:ease-in after:duration-500 px-2">
                    <div class="flex gap-2 items-center">
                        <h1>Logout </h1>
                        <img src="{{url('/asset/logout.svg')}}" class="w-4" />
                    </div>
                </div>
            </a>
        </div>
    </nav>

    <!-- sidebar -->
    <div id="sidebar" class="h-screen fixed z-10 w-60 top-0 bg-white transition -left-60 duration-700 px-5 py-20">
        <div class="flex flex-col gap-8 text-xl font-medium text-mainColor">
            <a href="/home" class="flex items-center gap-2">
                <img src="{{url('/asset/home.svg')}}" class="w-4" />
                <h1>Home</h1>
            </a>

            <a href="/event" class="flex items-center gap-2">
                <img src="{{url('/asset/event.svg')}}" class="w-4" />
                <h1>Event</h1>
            </a>

            <a href="/academy" class="flex items-center gap-2">
                <img src="{{url('/asset/book.svg')}}" class="w-4" />
                <h1>Academy</h1>
            </a>

            <a href="/logout" class="flex items-center gap-2">
                <img src="{{url('/asset/logout.svg')}}" class="w-4" />
                <h1>Logout </h1>
            </a>

        </div>
    </div>
    <!-- sidebar -->
    @endauth

    <!-- background modal -->
    <div id="modal" class="fixed w-full h-full bg-[#000000e1] hidden"></div>
    <!-- background modal -->
    @yield('content')

    <script src="{{url('/script/script.js')}}"></script>
    @livewireScripts
</body>

</html>