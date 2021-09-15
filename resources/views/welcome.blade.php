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
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- <link href="https://unpkg.com/tailwindcss@2.2.4/dist/tailwind.min.css" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
</head>

<body class="h-screen overflow-hidden" style="background: #edf2f7;">
    <div id="app">
        <div class="relative min-h-screen flex ">
            <div
                class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">
                <div class="sm:w-1/2 xl:w-3/5 h-full hidden md:flex flex-auto items-center justify-center p-10 overflow-hidden bg-purple-900 text-white bg-no-repeat bg-cover relative"
                    style="background-image: url(images/cover.jpg);">
                    <div class="absolute bg-gradient-to-b bg-green_cus-500 to-blue-500 opacity-75 inset-0 z-0"></div>
                    <div class="w-full  max-w-md z-10">
                        <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6">LPKN
                            Whatsapp
                            Service
                            Center</div>
                        <div class="sm:text-sm xl:text-md text-gray-200 font-normal">Web khusus admin LPKN yang difungsikan untuk merespon semua keluhan,
                            masukkan,
                            dan konsultasi dengan
                            pesanan yang akan berlangsung.</div>
                    </div>
                    <!---remove custom style-->
                    <ul class="circles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <div  class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full w-2/5 xl:w-2/5 p-8  md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-white">
                    <div class="max-w-md w-full space-y-8">
                        @guest
                        <div class="text-center">
                            <img src="/images/lpkn.png" class="img-fluid">

                            <h2 class="mt-6 text-3xl font-bold text-gray-900">
                                Welcome Back!
                            </h2>
                            <p class="mt-2 text-sm text-gray-500">Please sign in to your account</p>
                        </div>


                        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="hidden" name="remember" value="true">
                            <div class="relative">
                                <div class="absolute right-3 mt-4">
                                    @error('email')
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @enderror

                                </div>
                                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
                                <input
                                    class=" @error('email') is-invalid @enderror w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
                                    id="email" type="email" placeholder="Your Email" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            <div class="mt-8 content-center">
                                <div class="absolute right-3 mt-4">
                                    @error('password')
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @enderror

                                </div>
                                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                                    Password
                                </label>
                                <input
                                    class=" @error('password') is-invalid @enderror w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500"
                                    type="password" placeholder="Enter your password" name="password"
                                    placeholder="Your Password" required autocomplete="current-password">
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember_me" name="remember_me" type="checkbox"
                                        class="h-4 w-4 bg-blue-500 focus:ring-blue-400 border-gray-300 rounded">
                                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                        Remember me
                                    </label>
                                </div>
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="text-indigo-400 hover:text-blue-500">
                                        Forgot your password?
                                    </a>
                                </div>
                            </div>
                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center bg-gradient-to-r bg-green_cus-700 bg-green_cus-500  hover:bg-green_cus-500 hover:bg-green_cus-500 hover:from-green-500 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                                    {{ __('Masuk') }}
                                </button>
                            </div>

                        </form>
                        @else


                        @role('admin')
                            <a href="{{ route('home') }}"
                                class="w-full flex justify-center bg-gradient-to-r bg-green-500 to-pink-600  hover:bg-green_cus-400 hover:bg-pink-500 hover:to-indigo-600 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">Respon
                                Sekarang!</a>
                            <a href="{{ route('approval') }}"
                                class="w-full flex justify-center bg-gradient-to-r bg-pink-500 to-green-600  hover:bg-green_cus-400 hover:bg-green-500 hover:to-indigo-600 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">Manage
                                User</a>
                            <a href="{{ route('credential') }}"
                                class="w-full flex justify-center bg-gradient-to-r bg-yellow-500 to-green-600  hover:bg-green_cus-400 hover:bg-green-500 hover:to-indigo-600 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">Manage
                                Credential</a>

                        @endrole
                        @role('user')
                        <div class="mx-auto my-6 md:w-1/2 w-80 object-center grid grid-cols-1">
                            <button
                                class="btn border-2 w-11/12 border-green-500 bg-green-500 bg-opacity-50 hover:bg-opacity-100 text-white shadow-lg justify-self-center">Respon
                                Sekarang!</button>
                        </div>
                        @endrole
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex justify-center bg-gradient-to-r bg-green_cus-400 to-blue-600  hover:bg-green_cus-400 hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                                {{ __('Keluar') }}
                            </button>
                        </form>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
