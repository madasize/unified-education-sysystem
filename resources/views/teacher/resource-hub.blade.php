<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Resource Hub') }}</h2>
            <p class="text-sm text-gray-500">Upload and manage teaching materials for your classroom.</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @livewire('teacher.resource-hub')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>