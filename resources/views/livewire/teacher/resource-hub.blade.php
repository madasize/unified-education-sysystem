<div class="space-y-6">
    <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
        <div class="flex flex-col md:flex-row md:items-end gap-4">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700">Resource Title</label>
                <input type="text" wire:model="title" class="mt-2 w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="E.g. Term 1 Lesson Plan" />
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="w-48">
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select wire:model="resource_type" class="mt-2 w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="document">Document</option>
                    <option value="video">Video</option>
                    <option value="slide">Slide</option>
                    <option value="link">Link</option>
                </select>
                @error('resource_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid gap-4 md:grid-cols-2 mt-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea wire:model="description" rows="3" class="mt-2 w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Optional summary..."></textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Link</label>
                <input type="text" wire:model="link" class="mt-2 w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="https://..." />
                @error('link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-4 flex items-center justify-between gap-4">
            <button wire:click="saveResource" class="inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3 text-sm font-semibold text-white hover:bg-blue-700">Save Resource</button>
            @if(session()->has('message'))
                <p class="text-emerald-600 text-sm font-medium">{{ session('message') }}</p>
            @endif
        </div>
    </div>

    <div class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900">Your Teaching Resources</h3>
        <div class="mt-5 space-y-4">
            @forelse($resources as $resource)
                <div class="rounded-3xl border border-gray-200 bg-gray-50 p-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <p class="font-semibold text-gray-900">{{ $resource->title }}</p>
                        <p class="text-sm text-gray-500">{{ ucfirst($resource->resource_type) }} · {{ $resource->created_at->diffForHumans() }}</p>
                        @if($resource->description)
                            <p class="mt-2 text-sm text-gray-600">{{ $resource->description }}</p>
                        @endif
                        @if($resource->link)
                            <a href="{{ $resource->link }}" target="_blank" class="text-blue-600 text-sm hover:underline">Open link</a>
                        @endif
                    </div>
                    <button wire:click="deleteResource({{ $resource->id }})" class="rounded-2xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100">Delete</button>
                </div>
            @empty
                <div class="rounded-3xl border border-dashed border-gray-200 p-6 text-center text-sm text-gray-500">
                    No resources uploaded yet.
                </div>
            @endforelse
        </div>
    </div>
</div>
