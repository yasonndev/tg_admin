<div class="">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div class="flex-1">
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="🔍 Search by name or email..."
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
            >
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" wire:model.live="activeOnly" id="activeOnly" class="w-4 h-4">
            <label for="activeOnly" class="text-sm font-medium text-gray-700 cursor-pointer">
                Only Active Users
            </label>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-3 text-sm font-semibold text-gray-600">ID</th>
                <th class="p-3 text-sm font-semibold text-gray-600">Name</th>
                <th class="p-3 text-sm font-semibold text-gray-600">Email</th>
                <th class="p-3 text-sm font-semibold text-gray-600">Joined</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
                <tr wire:key="{{ $user->id }}" class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 text-sm text-gray-500">#{{ $user->id }}</td>
                    <td class="p-3 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                    <td class="p-3 text-sm text-gray-600">{{ $user->email }}</td>
                    <td class="p-3 text-sm text-gray-500">{{ $user->created_at->format('d.m.Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-gray-400">
                        No users found for "{{ $search }}"
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->links('components/paginator', [
                'pagiAdditionalUri' => '',
            //                'size' => 'large',
            //                'border' => 'no-radius',
            //                'center' => 'center'
            ]) }}
    </div>
</div>
