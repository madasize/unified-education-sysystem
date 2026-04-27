<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Inspection') }}</h2>
            <p class="text-sm text-gray-500">Log and view school inspection reports across your cluster.</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @livewire('cluster.inspection')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
