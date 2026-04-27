<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Teacher Recommendations</h3>
            <p class="text-sm text-gray-600 mt-1">Review and respond to teacher comments and suggestions</p>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-2 border-b border-gray-200">
        @foreach(['pending' => 'Pending', 'reviewed' => 'Reviewed', 'accepted' => 'Accepted', 'rejected' => 'Rejected'] as $value => $label)
            <button
                wire:click="updateFilters('{{ $value }}')"
                @class([
                    'px-4 py-2 text-sm font-medium border-b-2 transition-colors',
                    'border-blue-500 text-blue-600' => $filterStatus === $value,
                    'border-transparent text-gray-600 hover:text-gray-900' => $filterStatus !== $value,
                ])
            >
                {{ $label }}
            </button>
        @endforeach
    </div>

    <!-- Recommendations List -->
    <div class="space-y-3">
        @forelse($recommendations as $rec)
            <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer"
                wire:click="viewRecommendation({{ $rec->id }})">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900">{{ $rec->subject }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit($rec->comment, 100) }}</p>
                        <div class="flex gap-2 mt-2 text-xs">
                            <span class="text-gray-500">{{ $rec->teacher->name }}</span>
                            <span class="text-gray-400">•</span>
                            <span class="text-gray-500">{{ $rec->school->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <span @class([
                        'px-3 py-1 rounded-full text-xs font-medium',
                        'bg-yellow-100 text-yellow-700' => $rec->status === 'pending',
                        'bg-blue-100 text-blue-700' => $rec->status === 'reviewed',
                        'bg-green-100 text-green-700' => $rec->status === 'accepted',
                        'bg-red-100 text-red-700' => $rec->status === 'rejected',
                    ])>
                        {{ ucfirst($rec->status) }}
                    </span>
                </div>
                <div class="text-xs text-gray-400 mt-2">{{ $rec->created_at->format('M d, Y H:i') }}</div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500">
                <p>No {{ strtolower($filterStatus) }} recommendations yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $recommendations->links() }}
    </div>

    <!-- Detail Modal -->
    @if($selectedRecommendation)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg max-w-2xl w-full max-h-96 overflow-y-auto">
                <div class="p-6 border-b border-gray-200 flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $selectedRecommendation->subject }}</h3>
                        <p class="text-sm text-gray-600">From {{ $selectedRecommendation->teacher->name }}</p>
                    </div>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Comment</h4>
                        <p class="text-gray-600">{{ $selectedRecommendation->comment }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">Teacher: <span class="font-medium">{{ $selectedRecommendation->teacher->name }}</span></p>
                        </div>
                        <div>
                            <p class="text-gray-600">School: <span class="font-medium">{{ $selectedRecommendation->school->name ?? 'N/A' }}</span></p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Ministry Notes</label>
                        <textarea wire:model="ministryNotes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Add notes for this recommendation..."></textarea>
                    </div>

                    <div class="flex gap-2 justify-end pt-4 border-t border-gray-200">
                        <button wire:click="closeModal" class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                            Cancel
                        </button>
                        <button wire:click="reviewRecommendation({{ $selectedRecommendation->id }}, 'rejected')"
                            class="px-4 py-2 text-sm text-white bg-red-500 rounded-lg hover:bg-red-600">
                            Reject
                        </button>
                        <button wire:click="reviewRecommendation({{ $selectedRecommendation->id }}, 'accepted')"
                            class="px-4 py-2 text-sm text-white bg-green-500 rounded-lg hover:bg-green-600">
                            Accept
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
