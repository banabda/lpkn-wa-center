<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
</head>

<body>
    <div id="app">
        <main class="pt-4 container-fluid h-screen bg-purple-600 bg-opacity-100 grid content-center">
            <div class="mx-auto object-center bg-white p-6 rounded-lg w-1/2 shadow-lg">
                <p class="capitalize text-3xl font-bold font-sans mb-4 text-justify">Selamat datang di web LPKN Whatsapp
                    Service
                    Center!
                </p>
                <p class="text-justify text-md">Web khusus admin lpkn yang difungsikan untuk merespon semua keluhan,
                    masukkan,
                    dan konsultasi dengan
                    event yang akan berlangsung. </p>
            </div>
            @guest
                <div class="mx-auto my-6 w-1/2 object-center grid grid-cols-2 space-x-6 self-center">
                    <a href="{{ route('login') }}"
                        class="btn border-2 border-blue-500 bg-blue-500 bg-opacity-50 hover:bg-opacity-100 text-white shadow-lg">Login</a>
                    <a href="{{ route('register') }}"
                        class="btn border-2 border-red-500 bg-red-500 bg-opacity-50 hover:bg-opacity-100 text-white shadow-lg">Register</a>
                </div>
            @else
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="text-purple-700 absolute top-0 right-0 pr-4 pt-2 font-bold btn focus:border-0">
                        Logout
                    </button>
                </form>
                @role('admin')
                <div class="mx-auto my-6 w-1/2 object-center grid grid-cols-3 space-x-6 self-center">
                    <a href="{{ route('home') }}"
                        class="btn border-2 border-green-500 bg-green-500 bg-opacity-50 hover:bg-opacity-100 text-white shadow-lg">Respon
                        Sekarang!</a>
                    <a href="{{ route('approval') }}"
                        class="btn border-2 border-pink-500 bg-pink-500 bg-opacity-50 hover:bg-opacity-100 text-white shadow-lg">Manage
                        User</a>
                    <a href="{{ route('credential') }}"
                        class="btn border-2 border-yellow-500 bg-yellow-500 bg-opacity-50 hover:bg-opacity-100 text-white shadow-lg">Manage
                        Credential</a>
                </div>
                @endrole
                @role('user')
                <div class="mx-auto my-6 w-1/2 object-center grid grid-cols-1 space-x-6 self-center">
                    <button
                        class="btn border-2 border-green-500 bg-green-500 bg-opacity-50 hover:bg-opacity-100 text-white shadow-lg">Respon
                        Sekarang!</button>
                </div>
                @endrole
            @endguest
        </main>
    </div>
</body>

</html>
