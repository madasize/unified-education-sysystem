<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Policy Control') }}</h2>
                <p class="text-sm text-gray-500">Create and manage national education policies and directives.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">Draft New Policy</h3>
                    <div class="mt-4 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Policy Title</label>
                            <input type="text" class="mt-2 w-full border border-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Example: Digital Learning Guidelines" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea rows="5" class="mt-2 w-full border border-gray-300 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Outline the policy goals and implementation plan."></textarea>
                        </div>
                        <button class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 text-white rounded-xl text-sm font-semibold hover:bg-blue-700">Save Draft</button>
                    </div>
                </div>
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Policies</h3>
                    <div class="mt-4 space-y-4 text-sm text-gray-600">
                        <div class="rounded-2xl border border-gray-200 p-4">
                            <div class="flex justify-between items-start gap-3">
                                <div>
                                    <h4 class="font-semibold text-gray-900">National STEM Curriculum</h4>
                                    <p class="text-xs text-gray-500">Published 12 April 2026</p>
                                </div>
                                <span class="text-xs text-green-700 bg-green-100 px-2 py-1 rounded-full">Active</span>
                            </div>
                            <p class="mt-3 text-sm text-gray-600">New guidelines for STEM teacher training and assessment updates.</p>
                        </div>
                        <div class="rounded-2xl border border-gray-200 p-4">
                            <div class="flex justify-between items-start gap-3">
                                <div>
                                    <h4 class="font-semibold text-gray-900">School Safety Standards</h4>
                                    <p class="text-xs text-gray-500">Published 22 March 2026</p>
                                </div>
                                <span class="text-xs text-yellow-700 bg-yellow-100 px-2 py-1 rounded-full">Review</span>
                            </div>
                            <p class="mt-3 text-sm text-gray-600">Guidance on improving learning environments and student wellbeing.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900">Policy Status Overview</h3>
                <div class="mt-6 grid gap-4 sm:grid-cols-3">
                    <div class="rounded-3xl border border-gray-200 p-5 bg-gray-50">
                        <p class="text-xs text-gray-500 uppercase tracking-[0.2em]">Published</p>
                        <p class="mt-3 text-3xl font-bold text-gray-900">8</p>
                    </div>
                    <div class="rounded-3xl border border-gray-200 p-5 bg-gray-50">
                        <p class="text-xs text-gray-500 uppercase tracking-[0.2em]">Drafts</p>
                        <p class="mt-3 text-3xl font-bold text-gray-900">3</p>
                    </div>
                    <div class="rounded-3xl border border-gray-200 p-5 bg-gray-50">
                        <p class="text-xs text-gray-500 uppercase tracking-[0.2em]">Under Review</p>
                        <p class="mt-3 text-3xl font-bold text-gray-900">2</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
