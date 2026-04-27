<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('National Analytics') }}</h2>
                <p class="text-sm text-gray-500">View national performance trends and key education metrics.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid gap-6 sm:grid-cols-3">
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                    <p class="text-sm text-gray-500">Enrollment Rate</p>
                    <p class="mt-4 text-3xl font-bold text-gray-900">92.4%</p>
                    <p class="mt-2 text-sm text-gray-500">Current registered learners nationwide.</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                    <p class="text-sm text-gray-500">Pass Rate</p>
                    <p class="mt-4 text-3xl font-bold text-gray-900">78.3%</p>
                    <p class="mt-2 text-sm text-gray-500">Students meeting the national benchmark.</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                    <p class="text-sm text-gray-500">Attendance</p>
                    <p class="mt-4 text-3xl font-bold text-gray-900">88.7%</p>
                    <p class="mt-2 text-sm text-gray-500">Average daily school attendance.</p>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Performance Trends</h3>
                    <span class="text-sm text-gray-500">Year-to-date overview</span>
                </div>
                <div class="h-80 bg-gray-50 rounded-3xl flex items-center justify-center text-gray-400">
                    <p>Chart placeholder — implement charting library here.</p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">Top Performing Regions</h3>
                    <ul class="mt-4 space-y-3 text-sm text-gray-600">
                        <li class="flex justify-between"><span>Central</span><span class="font-semibold text-gray-900">89.2%</span></li>
                        <li class="flex justify-between"><span>Southern</span><span class="font-semibold text-gray-900">86.8%</span></li>
                        <li class="flex justify-between"><span>Northern</span><span class="font-semibold text-gray-900">84.1%</span></li>
                    </ul>
                </div>
                <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">Critical Focus Areas</h3>
                    <ul class="mt-4 space-y-3 text-sm text-gray-600">
                        <li>Improve rural attendance</li>
                        <li>Increase digital learning access</li>
                        <li>Support low-performing districts</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
