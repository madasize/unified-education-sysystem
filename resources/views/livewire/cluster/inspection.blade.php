<div class="space-y-6">
    <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Add Inspection Report</h3>
                <p class="mt-1 text-sm text-gray-500">Record observations for cluster schools.</p>
            </div>
        </div>

        <div class="mt-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">School Name</label>
                <input type="text" wire:model.defer="school_name" class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                @error('school_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Findings</label>
                <textarea wire:model.defer="findings" rows="4" class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('findings') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Inspection Date</label>
                <input type="date" wire:model.defer="inspected_at" class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                @error('inspected_at') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <button wire:click="saveReport" class="inline-flex items-center rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Save Report</button>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="rounded-3xl border border-green-100 bg-green-50 p-4 text-green-800">{{ session('message') }}</div>
    @endif

    <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900">Most Recent Inspection Reports</h3>
        <div class="mt-6 space-y-4">
            @forelse($reports as $report)
                <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $report->school_name }}</p>
                            <p class="text-sm text-gray-500">Inspected {{ $report->inspected_at->format('M j, Y') }} · Status: <span class="font-semibold">{{ ucfirst($report->status) }}</span></p>
                            <p class="mt-3 text-sm text-gray-700">{{ $report->findings }}</p>
                        </div>
                        @if($report->status !== 'closed')
                            <button wire:click="closeReport({{ $report->id }})" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Close</button>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">No inspection reports yet.</p>
            @endforelse
        </div>
        <div class="mt-6">{{ $reports->links() }}</div>
    </div>
</div>
