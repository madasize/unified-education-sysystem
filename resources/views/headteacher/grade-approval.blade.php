<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Grade Approval') }}</h2>
            <p class="text-sm text-gray-500">Review and approve marks submitted by teachers.</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @livewire('headteacher.grade-approval')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>