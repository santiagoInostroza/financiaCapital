<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

   
        <title>{{ config('app.name', 'FC') }} @yield('title')</title>

        {{-- FONT AWESOME 5 --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @livewireStyles
        

        <style>   
            @import url('https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Source+Sans+Pro:wght@300;400;600;700&display=swap');
               
            [x-cloak] { display: none; }
            @media screen and (max-width: 768px) {
                [x-cloak="mobile"] { display: none; }
            }
            .font-sans-pro {
                font-family: 'Source Sans Pro', sans-serif;
            }
        </style>

          {{-- SWEET ALERT --}}
          <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
         
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{asset('js/myJs.js') }}"></script>
        
    </head>
    <body class="min-h-screen font-sans antialiased bg-gray-900 font-sans-pro">
        <x-jet-banner />

       
        <div class="min-h-screen ">


           

            <livewire:header>

            @if (session()->has('success'))
                <x-alerts.success>
                    {{ session('success') }}
                </x-alerts.success>   
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
