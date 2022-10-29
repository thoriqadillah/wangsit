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
    @yield('error')

    @if (!isset($exception))
    @auth
    <nav class="w-full flex h-16 px-5 lg:px-16 items-center bg-white shadow z-20 fixed justify-between">
        <img src="{{url('/asset/icons/menu.svg')}}" class="w-6 lg:hidden" onclick="mySidebar()" />
        <img src="{{url('/asset/icons/logo.png')}}" class="w-24 lg:w-32" />
        <div class="hidden lg:flex items-center gap-8 text-xl text-mainColor">
            <a href="/">
                <div class="{{ (request()->is('/')) ? 'after:content-[\'\'] after:w-full after:h-[2px] after:bg-mainColor after:absolute after:-bottom-1 after:rounded-full after:left-0 relative px-2' : 'hover:after:content-[\'\'] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2' }}">
                    Home
                </div>
            </a>

            <a href="/event">
                <div class="{{ (request()->is('event')) ? 'after:content-[\'\'] after:w-full after:h-[2px] after:bg-mainColor after:absolute after:-bottom-1 after:rounded-full after:left-0 relative px-2' : 'hover:after:content-[\'\'] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2' }}"">
                    Event
                </div>
            </a>
            <a href=" /academy">
                    <div class="{{ (request()->is('academy')) ? 'after:content-[\'\'] after:w-full after:h-[2px] after:bg-mainColor after:absolute after:-bottom-1 after:rounded-full after:left-0 relative px-2' : 'hover:after:content-[\'\'] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2' }}">
                        Academy
                    </div>
            </a>
            @if (auth()->check() && auth()->user()->admin != null)
            <div class="relative cursor-default group">
                <div class="flex items-center gap-2">
                    <h1>Admin</h1>
                    <img src="{{url('/asset/icons/drop.svg')}}" class="w-3" />
                </div>

                <div class="absolute hidden -left-6 group-hover:block p-3 w-60">
                    <div class="flex flex-col gap-5 bg-white shadow-lg border p-5">
                        @if (auth()->check() && auth()->user()->admin != null && auth()->user()->admin->departement_id != null)
                        <a href="/admin/event" class="{{ (request()->is('admin/event')) ? 'after:content-[\'\'] after:w-full after:h-[2px] after:bg-mainColor after:absolute after:-bottom-1 after:rounded-full after:left-0 relative px-2' : 'hover:after:content-[\'\'] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2' }}">Event</a>
                        <a href="/admin/academy" class="{{ (request()->is('admin/academy')) ? 'after:content-[\'\'] after:w-full after:h-[2px] after:bg-mainColor after:absolute after:-bottom-1 after:rounded-full after:left-0 relative px-2' : 'hover:after:content-[\'\'] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2' }}">Academy</a>
                        @else
                        <a href=" /admin/root" class="{{ (request()->is('admin/root')) ? 'after:content-[\'\'] after:w-full after:h-[2px] after:bg-mainColor after:absolute after:-bottom-1 after:rounded-full after:left-0 relative px-2' : 'hover:after:content-[\'\'] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2' }}">Root</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-2">
                    <h1>Logout </h1>
                    <img src="{{url('/asset/icons/logout.svg')}}" class="w-4" />
                </button>
            </form>
        </div>
    </nav>

    <!-- sidebar -->
    <div id="sidebar" class="h-screen fixed w-60 top-0 bg-white transition -translate-x-60 duration-700 px-5 z-[900] py-20">
        <div class="flex flex-col gap-8 text-xl font-medium text-mainColor">
            <a href="/" class="flex items-center gap-2">
                <img src="{{url('/asset/icons/home.svg')}}" class="w-4" />
                <h1>Home</h1>
            </a>

            <a href="/event" class="flex items-center gap-2">
                <img src="{{url('/asset/icons/event.svg')}}" class="w-4" />
                <h1>Event</h1>
            </a>

            <a href="/academy" class="flex items-center gap-2">
                <img src="{{url('/asset/icons/book.svg')}}" class="w-4" />
                <h1>Academy</h1>
            </a>

            @if (auth()->check() && auth()->user()->admin != null)
            <div class="relative cursor-default group">
                <div class="flex items-center gap-2">
                    <img src="{{url('/asset/icons/user.svg')}}" class="w-4" />
                    <div class="flex items-center gap-2">
                        <h1>Admin</h1>
                        <img src="{{url('/asset/icons/drop.svg')}}" class="w-3" />
                    </div>
                </div>

                <div class="absolute hidden -left-6 group-hover:block p-3 w-60">
                    <div class="flex flex-col gap-5 bg-white shadow-lg border p-5">
                        @if (auth()->check() && auth()->user()->admin != null && auth()->user()->admin->departement_id != null)
                        <a href="/admin/event" class="{{ (request()->is('/admin/event')) ? 'after:content-[\'\'] after:w-full after:h-[2px] after:bg-mainColor after:absolute after:-bottom-1 after:rounded-full after:left-0 relative px-2' : 'hover:after:content-[\'\'] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2' }}">Event</a>
                        <a href="/admin/academy" class="{{ (request()->is('/admin/academy')) ? 'after:content-[\'\'] after:w-full after:h-[2px] after:bg-mainColor after:absolute after:-bottom-1 after:rounded-full after:left-0 relative px-2' : 'hover:after:content-[\'\'] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2' }}">Academy</a>
                        @else
                        <a href="/admin/root" class="{{ (request()->is('/admin/root')) ? 'after:content-[\'\'] after:w-full after:h-[2px] after:bg-mainColor after:absolute after:-bottom-1 after:rounded-full after:left-0 relative px-2' : 'hover:after:content-[\'\'] hover:after:w-full hover:after:h-[2px] hover:after:bg-mainColor hover:after:absolute hover:after:-bottom-1 hover:after:rounded-full hover:after:left-0 hover:relative  after:transition after:ease-in after:duration-500 px-2' }}">Root</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-2">
                    <img src="{{url('/asset/icons/logout.svg')}}" class="w-4" />
                    <h1>Logout </h1>
                </button>
            </form>

        </div>
    </div>
    <!-- sidebar -->
    @endauth
    @endif

    @yield('content')
    <!-- background modal -->
    <div id="modal" class="fixed w-full top-0 bottom-0 right-0 left-0 scale-0 transition duration-500 bg-[#000000e1] z-[800]"></div>
    <!-- background modal -->

    <script src="{{url('/script/script.js')}}"></script>
    @livewireScripts
</body>

</html>