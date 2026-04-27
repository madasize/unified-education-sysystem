<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Grade Approval</h3>
            <p class="mt-1 text-sm text-gray-600">Approve teacher-submitted grades before they are finalized.</p>
        </div>
        <button wire:click="togglePendingFilter" class="rounded-2xl border border-gray-200 bg-gray-50 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100">
            {{ $showOnlyPending ? 'Show All Grades' : 'Show Pending Only' }}
        </button>
    </div>

    @if(session()->has('message'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">{{ session('message') }}</div>
    @endif

    <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] tracking-widest">
                <tr>
                    <th class="px-6 py-4">Teacher</th>
                    <th class="px-6 py-4">Student</th>
                    <th class="px-6 py-4">Subject</th>
                    <th class="px-6 py-4">Term</th>
                    <th class="px-6 py-4">Score</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($grades as $grade)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">{{ $grade->teacher?->name ?? 'Unknown' }}</td>
                        <td class="px-6 py-4">{{ $grade->student_name }}</td>
                        <td class="px-6 py-4">{{ $grade->subject }}</td>
                        <td class="px-6 py-4">{{ $grade->term }}</td>
                        <td class="px-6 py-4">{{ number_format($grade->score, 1) }}%</td>
                        <td class="px-6 py-4">
                            <span class="rounded-full px-3 py-1 text-[11px] font-semibold {{ $grade->is_synced ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $grade->is_synced ? 'Approved' : 'Pending' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            @unless($grade->is_synced)
                                <button wire:click="approveGrade({{ $grade->id }})" class="rounded-2xl bg-blue-600 px-4 py-2 text-xs font-semibold text-white hover:bg-blue-700">Approve</button>
                            @endunless
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-400">No grade submissions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>{{ $grades->links() }}</div>
</div>
