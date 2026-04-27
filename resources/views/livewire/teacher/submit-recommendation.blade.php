<div class="space-y-4">
    @if($submitted)
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-green-700 text-sm">
            ✓ Your recommendation has been submitted successfully. The Ministry will review it shortly.
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
            <input type="text" wire:model="subject"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="What is your recommendation about?">
            @error('subject') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Your Recommendation</label>
            <textarea wire:model="comment" rows="4"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Share your ideas, suggestions, or concerns..."></textarea>
            @error('comment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <button type="submit"
            class="px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors">
            Submit Recommendation
        </button>
    </form>
</div>
