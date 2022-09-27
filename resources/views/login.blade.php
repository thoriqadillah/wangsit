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
    <img src="{{url('/asset/logo.png')}}" class="block mx-auto mt-28 md:mt-10" />

    <div class="grid grid-cols-1 lg:grid-cols-2 px-5 mt-5">
        <div class="hidden lg:block">
            <img src="{{url('/asset/ilustrasi1.png')}}" class="block mx-auto w-96" />

            <h1 class="font-bold text-3xl">Wangsit Auth</h1>
            <p>
                Warung Angkringan SI Terhits (WANGSIT) merupakan sebuah sistem autentikasi untuk mahasiswa program studi Sistem Informasi FILKOM UB, di dalamnya terdapat Wangsit Event yang berisi informasi seputar event yang ada di KBMSI serta Wangsit Academy yang berisi materi-materi pembelajaran yang ada di Sistem Informasi.
            </p>
        </div>
        <div class="w-full md:px-40 lg:px-32">
            <form class="border border-mainColor rounded shadow mt-5">
                <div class="w-full text-center py-3 font-medium text-xl bg-mainColor rounded-t text-white">
                    Login
                </div>
                <div class="px-4 w-full flex-col flex gap-5 my-8">
                    <input type="text" class="bg-gray-100 p-2 rounded outline-none" placeholder="NIM" />
                    <input type="password" class="bg-gray-100 p-2 rounded outline-none" placeholder="Password" />
                    <input type="submit" value="Login" class="block bg-mainColor text-white w-full rounded py-2 mt-3" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>