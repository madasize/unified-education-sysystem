<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between bg-white rounded-3xl border border-gray-100 p-6 shadow-sm">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Teacher Accounts</h3>
            <p class="mt-1 text-sm text-gray-600">Manage teacher and headteacher accounts for your school.</p>
        </div>
        <input type="text" wire:model.debounce.300ms="search" placeholder="Search by name or email" class="w-full max-w-sm rounded-2xl border border-gray-300 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
    </div>

    @if(session()->has('message'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700">{{ session('message') }}</div>
    @endif

    <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-sm">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-gray-400 uppercase text-[10px] tracking-widest">
                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</td>
                        <td class="px-6 py-4">
                            <span class="rounded-full px-3 py-1 text-[11px] font-semibold {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="toggleActive({{ $user->id }})" class="rounded-2xl border px-4 py-2 text-xs font-semibold {{ $user->is_active ? 'border-red-200 text-red-700 bg-red-50 hover:bg-red-100' : 'border-blue-200 text-blue-700 bg-blue-50 hover:bg-blue-100' }}">
                                {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-400">No teacher accounts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>{{ $users->links() }}</div>
</div>
