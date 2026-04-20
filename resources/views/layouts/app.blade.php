<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'USEMS') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900 bg-[#f9fafb]">
        <div class="flex min-h-screen">
            
            <aside class="w-64 bg-[#111827] text-white flex flex-col fixed inset-y-0 z-50">
                <div class="p-6 border-b border-gray-800 flex items-center gap-3">
                    <div class="h-8 w-8 bg-emerald-600 rounded-lg flex items-center justify-center text-white font-bold">
                        U
                    </div>
                    <span class="text-xl font-bold tracking-tight">USEMS</span>
                </div>

                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <livewire:layout.navigation />
                </nav>

                <div class="p-4 border-t border-gray-800 bg-[#0b0f1a]">
                    <div class="flex items-center gap-3 text-sm">
                        <div class="h-8 w-8 rounded-full bg-emerald-500 flex items-center justify-center font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="truncate">
                            <p class="font-medium truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400 uppercase tracking-widest">{{ auth()->user()->role ?? 'Teacher' }}</p>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="flex-1 ml-64 flex flex-col">
                
                @if (isset($header))
                    <header class="bg-white border-b border-gray-200 sticky top-0 z-40">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                            <h2 class="font-semibold text-lg text-gray-800 leading-tight italic">
                                {{ $header }}
                            </h2>
                            <div class="text-xs text-emerald-600 font-bold bg-emerald-50 px-2 py-1 rounded">
                                OFFLINE SYNC: READY
                            </div>
                        </div>
                    </header>
                @endif

                <main class="p-8">
                    <div class="max-w-5xl mx-auto">
                        {{ $slot }}
                    </div>
                </main>

            </div>
        </div>
    </body>
</html>