<div class="space-y-6">
    <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-900">Allocate Resources</h3>
                <p class="mt-1 text-sm text-gray-500">Assign supplies to schools within your cluster.</p>
            </div>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">Resource Type</label>
                <input type="text" wire:model.defer="resource_type" class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                @error('resource_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" wire:model.defer="quantity" min="1" class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                @error('quantity') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">School Name</label>
                <input type="text" wire:model.defer="school_name" class="mt-1 block w-full rounded-2xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
                @error('school_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-6">
            <button wire:click="allocate" class="inline-flex items-center rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Allocate</button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="rounded-3xl border border-green-100 bg-green-50 p-4 text-green-800">{{ session('message') }}</div>
    @endif

    <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900">Recent Allocations</h3>
        <div class="mt-6 overflow-hidden rounded-3xl border border-gray-200">
            <div class="bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 sm:px-6">Allocations</div>
            <div class="divide-y divide-gray-200">
                @forelse($allocations as $allocation)
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $allocation->resource_type }}</p>
                                <p class="text-sm text-gray-500">School: {{ $allocation->school_name }}</p>
                            </div>
                            <p class="text-sm font-semibold text-indigo-600">Qty: {{ $allocation->quantity }}</p>
                        </div>
                    </div>
                @empty
                    <div class="px-4 py-4 sm:px-6 text-sm text-gray-500">No allocations recorded yet.</div>
                @endforelse
            </div>
        </div>

        <div class="mt-6">{{ $allocations->links() }}</div>
    </div>
</div>
