<div class="space-y-4">
    <div>
        <h4 class="text-sm font-medium text-gray-900 mb-3">Your Submitted Recommendations</h4>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-2 border-b border-gray-200 overflow-x-auto">
        @foreach(['all' => 'All', 'pending' => 'Pending', 'reviewed' => 'Reviewed', 'accepted' => 'Accepted', 'rejected' => 'Rejected'] as $value => $label)
            <button
                wire:click="updateFilter('{{ $value }}')"
                @class([
                    'px-3 py-2 text-xs font-medium border-b-2 whitespace-nowrap transition-colors',
                    'border-blue-500 text-blue-600' => $filterStatus === $value,
                    'border-transparent text-gray-600 hover:text-gray-900' => $filterStatus !== $value,
                ])
            >
                {{ $label }}
            </button>
        @endforeach
    </div>

    <!-- Recommendations Status -->
    <div class="space-y-2">
        @forelse($recommendations as $rec)
            <div class="bg-gray-50 border-l-4 rounded-r p-3"
                @class([
                    'border-yellow-500' => $rec->status === 'pending',
                    'border-blue-500' => $rec->status === 'reviewed',
                    'border-green-500' => $rec->status === 'accepted',
                    'border-red-500' => $rec->status === 'rejected',
                ])>
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h5 class="text-sm font-medium text-gray-900">{{ $rec->subject }}</h5>
                        <p class="text-xs text-gray-600 mt-1">{{ Str::limit($rec->comment, 60) }}</p>
                    </div>
                    <span @class([
                        'px-2 py-1 rounded text-xs font-medium whitespace-nowrap',
                        'bg-yellow-100 text-yellow-700' => $rec->status === 'pending',
                        'bg-blue-100 text-blue-700' => $rec->status === 'reviewed',
                        'bg-green-100 text-green-700' => $rec->status === 'accepted',
                        'bg-red-100 text-red-700' => $rec->status === 'rejected',
                    ])>
                        {{ ucfirst($rec->status) }}
                    </span>
                </div>
                <div class="text-xs text-gray-500 mt-2">
                    Submitted: {{ $rec->created_at->format('M d, Y') }}
                    @if($rec->reviewed_at)
                        | Reviewed: {{ $rec->reviewed_at->format('M d, Y') }}
                    @endif
                </div>
                @if($rec->ministry_notes)
                    <div class="text-xs text-gray-700 mt-2 pt-2 border-t border-gray-200">
                        <strong>Ministry Response:</strong> {{ $rec->ministry_notes }}
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-6 text-gray-500 text-sm">
                <p>No recommendations submitted yet.</p>
            </div>
        @endforelse
    </div>

    @if($recommendations->hasPages())
        <div class="mt-4">
            {{ $recommendations->links('pagination::tailwind') }}
        </div>
    @endif
</div>
