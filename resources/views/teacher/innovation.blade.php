<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Innovation') }}</h2>
            <p class="text-sm text-gray-500">Submit ideas and suggestions directly to the Ministry.</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-6">
                    <div class="rounded-3xl border border-gray-100 p-6 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Submit a New Idea</h3>
                        <p class="mt-2 text-sm text-gray-600">Share a recommendation on curriculum, school operations, or student support.</p>
                        <textarea class="mt-4 w-full rounded-2xl border border-gray-300 p-4 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" rows="5" placeholder="Write your suggestion here..."></textarea>
                        <button class="mt-4 inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700">Submit Suggestion</button>
                    </div>
                    <div class="rounded-3xl border border-gray-100 p-6 bg-white">
                        <h3 class="text-lg font-semibold text-gray-900">Past Submissions</h3>
                        <ul class="mt-4 space-y-4 text-sm text-gray-600">
                            <li class="rounded-2xl border border-gray-200 p-4 bg-gray-50">Request for more teacher training days — <span class="font-semibold text-gray-900">Pending review</span></li>
                            <li class="rounded-2xl border border-gray-200 p-4 bg-gray-50">Idea for improved digital learning materials — <span class="font-semibold text-gray-900">Reviewed</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
