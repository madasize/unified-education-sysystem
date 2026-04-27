<div class="space-y-4">
    <div class="grid grid-cols-1 gap-4">
        @forelse($updates as $update)
            <div class="border-l-4 rounded-r-lg p-4 cursor-pointer hover:shadow-md transition-shadow"
                wire:click="viewUpdate({{ $update->id }})"
                @class([
                    'border-red-500 bg-red-50' => $update->priority === 'high',
                    'border-yellow-500 bg-yellow-50' => $update->priority === 'medium',
                    'border-gray-500 bg-gray-50' => $update->priority === 'low',
                ])>
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-semibold text-gray-900">{{ $update->title }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($update->content, 80) }}</p>
                        <div class="flex gap-2 mt-2 text-xs">
                            <span class="text-gray-500">{{ $update->published_at->format('M d, Y') }}</span>
                            @if($update->expires_at)
                                <span class="text-gray-500">• Expires: {{ $update->expires_at->format('M d, Y') }}</span>
                            @endif
                        </div>
                    </div>
                    <span @class([
                        'px-2 py-1 rounded text-xs font-medium whitespace-nowrap',
                        'bg-red-200 text-red-700' => $update->priority === 'high',
                        'bg-yellow-200 text-yellow-700' => $update->priority === 'medium',
                        'bg-gray-200 text-gray-700' => $update->priority === 'low',
                    ])>
                        {{ ucfirst($update->priority) }}
                    </span>
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500 bg-gray-50 rounded-lg">
                <p>No active educational updates at the moment.</p>
            </div>
        @endforelse
    </div>

    @if($updates->hasPages())
        <div class="mt-6">
            {{ $updates->links() }}
        </div>
    @endif

    <!-- Detail Modal -->
    @if($selectedUpdate)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-96 overflow-y-auto">
                <div class="p-6 border-b border-gray-200 flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $selectedUpdate->title }}</h3>
                        <p class="text-sm text-gray-600">Published: {{ $selectedUpdate->published_at->format('M d, Y H:i') }}</p>
                    </div>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div class="prose prose-sm max-w-none">
                        {!! nl2br(e($selectedUpdate->content)) !!}
                    </div>

                    <div class="grid grid-cols-3 gap-4 text-sm pt-4 border-t border-gray-200">
                        <div>
                            <p class="text-gray-600">Priority</p>
                            <p class="font-semibold text-gray-900">{{ ucfirst($selectedUpdate->priority) }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Published</p>
                            <p class="font-semibold text-gray-900">{{ $selectedUpdate->published_at->format('M d, Y') }}</p>
                        </div>
                        @if($selectedUpdate->expires_at)
                            <div>
                                <p class="text-gray-600">Expires</p>
                                <p class="font-semibold text-gray-900">{{ $selectedUpdate->expires_at->format('M d, Y') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="flex gap-2 justify-end pt-4 border-t border-gray-200">
                        <button wire:click="closeModal"
                            class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
