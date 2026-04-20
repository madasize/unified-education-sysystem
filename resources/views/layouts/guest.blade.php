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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#f8fafc] relative">
            
            <div class="absolute inset-0 z-0 opacity-[0.03] pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2240%22 height=%2240%22 viewBox=%220 0 40 40%22%3E%3Cpath fill=%22%23000%22 fill-opacity=%221%22 d=%22M0%2038.59V40h1.41l21.18-21.18c.03-.02.05-.05.08-.08L40%202.41V0h-2.41l-18.76%2018.76c-.03.02-.05.05-.08.08L0%2038.59Zm38.59%200V40H40v-1.41L18.82%2018.82c-.03.03-.05.05-.08.08L0%202.41V0h2.41l18.76%2018.76c.03-.03.05-.05.08-.08L38.59%2038.59ZM20%2020L20%2020L20%2020L20%2020ZM20%2020L20%2020L20%2020L20%2020ZM20%2020L20%2020L20%2020L20%2020Z%22%3E%3C/path%3E%3C/svg%3E');"></div>

            <div class="z-10">
                <a href="/" wire:navigate>
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border border-gray-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>