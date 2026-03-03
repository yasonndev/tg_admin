<div>
    <div class="mb-4">
        <input wire:model.live.debounce.300ms="search" type="text"
               placeholder="Поиск по ID, Имени или @username..."
               class="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-gray-50 text-gray-600 text-sm uppercase">
                <th class="p-4 font-medium">User</th>
                <th class="p-4 font-medium">TG ID</th>
                <th class="p-4 font-medium">Username</th>
                <th class="p-4 font-medium">Lang</th>
                <th class="p-4 font-medium">Status</th>
                <th class="p-4 font-medium">Joined</th>
            </tr>
            </thead>
            <tbody class="divide-y">
            @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
                            {{ mb_substr($user->first_name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</div>
                        </div>
                    </td>
                    <td class="p-4 text-sm font-mono text-gray-500">#{{ $user->id }}</td>
                    <td class="p-4 text-sm text-blue-600">
                        @if($user->username)
                            <a href="https://t.me/{{ $user->username }}" target="_blank">@ {{ $user->username }}</a>
                        @else <span class="text-gray-300">none</span> @endif
                    </td>
                    <td class="p-4 text-sm text-gray-600">{{ strtoupper($user->language_code) }}</td>
                    <td class="p-4">
                        @if($user->is_premium)
                            <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded-full font-bold">⭐ Premium</span>
                        @else
                            <span class="text-gray-400 text-xs">Standard</span>
                        @endif
                    </td>
                    <td class="p-4 text-sm text-gray-500">{{ $user->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-gray-400">Пользователи не найдены</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
