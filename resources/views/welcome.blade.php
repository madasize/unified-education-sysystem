<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>USEMS - Malawi Education</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-[#fdfdfd] text-[#111827]">
        <div class="fixed inset-0 z-0 opacity-[0.03] pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22 viewBox=%220 0 40 40%22%3E%3Cpath fill=%22%23000%22 fill-opacity=%221%22 d=%22M0%2038.59V40h1.41l21.18-21.18c.03-.02.05-.05.08-.08L40%202.41V0h-2.41l-18.76%2018.76c-.03.02-.05.05-.08.08L0%2038.59Zm38.59%200V40H40v-1.41L18.82%2018.82c-.03.03-.05.05-.08.08L0%202.41V0h2.41l18.76%2018.76c.03-.03.05-.05.08-.08L38.59%2038.59ZM20%2020L20%2020L20%2020L20%2020ZM20%2020L20%2020L20%2020L20%2020ZM20%2020L20%2020L20%2020L20%2020Z%22%3E%3C/path%3E%3C/svg%3E');"></div>

        <div class="relative min-h-screen flex flex-col items-center justify-center z-10">
            
            @if (Route::has('login'))
                <div class="fixed top-0 right-0 p-6 text-right z-20">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-emerald-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-emerald-500 transition-colors">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-emerald-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-emerald-500 transition-colors">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-emerald-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-emerald-500 transition-colors">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-3xl w-full px-6 text-center">
                <div class="flex justify-center mb-10">
                    
                    <div class="h-24 w-24 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shadow-inner border border-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-14 h-14">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-x-2 mb-4">
                    <span class="text-xs font-semibold uppercase tracking-widest text-emerald-600 bg-emerald-100 px-3 py-1 rounded-full">Malawi</span>
                </div>

                <h1 class="text-4xl font-extrabold tracking-tighter text-gray-950 sm:text-7xl mb-6">
                    USEMS
                </h1>
                
                <p class="text-xl leading-8 text-gray-700 mb-12 max-w-xl mx-auto font-medium">
                    Unified Secondary Education Management System
                </p>

                <div class="flex items-center justify-center gap-x-6">
                    <a href="{{ route('login') }}" class="rounded-xl bg-emerald-600 px-8 py-4 text-base font-semibold text-white shadow-emerald-200 shadow-md hover:bg-emerald-500 hover:-translate-y-0.5 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition-all duration-150">
                        Launch System
                    </a>
                </div>
            </div>

            <div class="fixed bottom-0 w-full p-6 text-center text-sm text-gray-400">
                MoE Integrated Platform • v1.0
            </div>
        </div>
    </body>
</html>