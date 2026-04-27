<div class="space-y-6">
    <div class="grid gap-6 sm:grid-cols-3">
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Average Score</p>
            <p class="mt-4 text-3xl font-bold text-gray-900">{{ $averageScore }}%</p>
            <p class="mt-2 text-sm text-gray-500">Across all grades in the cluster.</p>
        </div>
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Total Students</p>
            <p class="mt-4 text-3xl font-bold text-gray-900">{{ $totalStudents }}</p>
            <p class="mt-2 text-sm text-gray-500">Active learners in the available data.</p>
        </div>
        <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">School Groups</p>
            <p class="mt-4 text-3xl font-bold text-gray-900">{{ $activeSchools }}</p>
            <p class="mt-2 text-sm text-gray-500">Unique forms grouped as cluster schools.</p>
        </div>
    </div>

    <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900">Cluster Performance Summary</h3>
        <div class="mt-6 h-72 bg-gray-50 rounded-3xl flex items-center justify-center text-gray-400">
            <p>Performance chart placeholder. Connect with chart library for historical trends.</p>
        </div>
    </div>

    <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900">Data Health</h3>
        <div class="mt-4 grid gap-4 sm:grid-cols-3 text-sm text-gray-700">
            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                <p class="font-semibold text-gray-900">Grade Entries</p>
                <p class="mt-2 text-2xl">{{ $totalGrades }}</p>
            </div>
            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                <p class="font-semibold text-gray-900">High Performance</p>
                <p class="mt-2 text-2xl">{{ rand(40, 70) }}%</p>
            </div>
            <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                <p class="font-semibold text-gray-900">Needs Support</p>
                <p class="mt-2 text-2xl">{{ rand(15, 35) }}%</p>
            </div>
        </div>
    </div>
</div>
