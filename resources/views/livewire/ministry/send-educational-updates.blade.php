<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Educational Updates</h3>
            <p class="text-sm text-gray-600 mt-1">Send updates to headteachers and cluster heads</p>
        </div>
        <button wire:click="openForm"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors">
            + New Update
        </button>
    </div>

    <!-- Updates List -->
    <div class="space-y-3">
        @forelse($updates as $update)
            <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            <h4 class="font-medium text-gray-900">{{ $update->title }}</h4>
                            <span @class([
                                'px-2 py-1 rounded text-xs font-medium',
                                'bg-red-100 text-red-700' => $update->priority === 'high',
                                'bg-yellow-100 text-yellow-700' => $update->priority === 'medium',
                                'bg-gray-100 text-gray-700' => $update->priority === 'low',
                            ])>
                                {{ ucfirst($update->priority) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($update->content, 100) }}</p>
                        <div class="flex gap-3 mt-2 text-xs text-gray-500">
                            <span>{{ ucfirst($update->status) }}</span>
                            @if($update->published_at)
                                <span>• Published: {{ $update->published_at->format('M d, Y') }}</span>
                            @endif
                            @if($update->target_recipients)
                                <span>• Targets: {{ implode(', ', $update->target_recipients) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="editUpdate({{ $update->id }})"
                            class="p-2 text-gray-600 hover:bg-gray-100 rounded">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button wire:click="deleteUpdate({{ $update->id }})"
                            onclick="return confirm('Are you sure?')"
                            class="p-2 text-red-600 hover:bg-red-50 rounded">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-8 bg-gray-50 rounded-lg text-gray-500">
                <p>No educational updates yet. Create one to get started.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($updates->hasPages())
        <div class="mt-6">
            {{ $updates->links() }}
        </div>
    @endif

    <!-- Create/Edit Form Modal -->
    @if($showForm)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-screen overflow-y-auto">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $editingId ? 'Edit Update' : 'Create New Update' }}
                    </h3>
                    <button wire:click="closeForm" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="saveUpdate" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" wire:model="title"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Update title...">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                        <textarea wire:model="content" rows="5"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Update content..."></textarea>
                        @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                            <select wire:model="priority"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select wire:model="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Target Recipients</label>
                        <div class="space-y-2">
                            @foreach(['headteacher' => 'Headteachers', 'cluster_head' => 'Cluster Heads', 'teacher' => 'Teachers'] as $value => $label)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" wire:model="targetRecipients" value="{{ $value }}"
                                        class="rounded border-gray-300 text-blue-500">
                                    <span class="text-sm">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Expires At (Optional)</label>
                        <input type="date" wire:model="expiresAt"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex gap-2 justify-end pt-4 border-t border-gray-200">
                        <button type="button" wire:click="closeForm"
                            class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                            {{ $editingId ? 'Update' : 'Create' }} Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
