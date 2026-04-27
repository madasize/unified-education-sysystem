<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Funding') }}</h2>
                <p class="text-sm text-gray-500">Monitor school grants and manage education funding streams.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid gap-6 sm:grid-cols-3">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                    <p class="text-sm text-gray-500">Total Grant Budget</p>
                    <p class="mt-4 text-3xl font-bold text-gray-900">MWK 14.8B</p>
                    <p class="mt-2 text-sm text-gray-500">Approved for the current financial year.</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                    <p class="text-sm text-gray-500">Committed Schools</p>
                    <p class="mt-4 text-3xl font-bold text-gray-900">235</p>
                    <p class="mt-2 text-sm text-gray-500">Institutions with active grants.</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                    <p class="text-sm text-gray-500">Disbursement Rate</p>
                    <p class="mt-4 text-3xl font-bold text-gray-900">61%</p>
                    <p class="mt-2 text-sm text-gray-500">Funds released to schools so far.</p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">Funding Activity</h3>
                    <div class="mt-4 h-72 bg-gray-50 rounded-3xl flex items-center justify-center text-gray-400">
                        <p>Graph placeholder — add funding trend visualization here.</p>
                    </div>
                </div>
                <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Grants</h3>
                    <div class="mt-4 space-y-4 text-sm text-gray-600">
                        <div class="rounded-3xl border border-gray-200 p-4">
                            <p class="font-semibold text-gray-900">Digital Classroom Expansion</p>
                            <p class="mt-2">MWK 450M allocated to 12 rural schools.</p>
                        </div>
                        <div class="rounded-3xl border border-gray-200 p-4">
                            <p class="font-semibold text-gray-900">Science Lab Upgrades</p>
                            <p class="mt-2">MWK 280M approved for 8 district schools.</p>
                        </div>
                        <div class="rounded-3xl border border-gray-200 p-4">
                            <p class="font-semibold text-gray-900">Teacher Training Fund</p>
                            <p class="mt-2">MWK 190M committed for national workshops.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900">Funding Management</h3>
                <div class="mt-6 grid gap-4 sm:grid-cols-3 text-sm text-gray-700">
                    <div class="rounded-3xl border border-gray-200 p-4 bg-gray-50">
                        <p class="font-semibold text-gray-900">Pending Approval</p>
                        <p class="mt-2 text-3xl">14</p>
                    </div>
                    <div class="rounded-3xl border border-gray-200 p-4 bg-gray-50">
                        <p class="font-semibold text-gray-900">Completed</p>
                        <p class="mt-2 text-3xl">38</p>
                    </div>
                    <div class="rounded-3xl border border-gray-200 p-4 bg-gray-50">
                        <p class="font-semibold text-gray-900">Under Review</p>
                        <p class="mt-2 text-3xl">9</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
