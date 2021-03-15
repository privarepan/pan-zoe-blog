<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="//{{request()->getHost()}}:6001/socket.io/socket.io.js"></script>
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased min-h-screen">
        <div>
            <livewire:navigation-menu/>
            <div>
                {{$slot}}
            </div>
        </div>
        <footer class="px-6 py-2 space-y-4 bg-gray-800 text-gray-100">
            <div class="flex justify-between">
                <span>友情链接：</span>
                <a href="https://learnku.com/laravel" class="hover:underline hover:text-pink-400 hover:font-bold">learnku-laravel</a>
                <a href="https://laravel-livewire.com" class="hover:underline hover:text-pink-400 hover:font-bold">laravel-livewire</a>
                <a href="http://tailwind.wyz.xyz" class="hover:underline hover:text-pink-400 hover:font-bold">tailwindcss</a>

            </div>
            <div class="flex flex-col justify-between items-center container md:flex-row">
                <a href="#" class="font-bold">由 Pan Zoe 编码</a>
                <p class="mt-2 md:mt-0">All rights reserved 2021.</p>
                <div class="flex -mx-2 mt-4 mb-2 md:mt-0 md:mb-0">

                </div>
            </div>
        </footer>
        @stack('modals')

        @livewireScripts
    </body>
</html>
