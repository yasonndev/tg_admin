<div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div class="flex-1">
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="🔍 Поиск бота по ID, имени или @username..."
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 outline-none"
            >
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" wire:model.live="onlyWithTokens" id="onlyWithTokens" class="w-4 h-4">
            <label for="onlyWithTokens" class="text-sm font-medium text-gray-700 cursor-pointer">
                Только с токенами
            </label>
        </div>
    </div>

    <div class="overflow-x-auto ">
        <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-3 text-sm font-semibold text-gray-600">ID (TG)</th>
                <th class="p-3 text-sm font-semibold text-gray-600">Bot Name</th>
                <th class="p-3 text-sm font-semibold text-gray-600">Username</th>
                <th class="p-3 text-sm font-semibold text-gray-600 text-center">Bot Token</th>
                <th class="p-3 text-sm font-semibold text-gray-600 text-center">API Key</th>
                <th class="p-3 text-sm font-semibold text-gray-600 text-right">Added At</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($bots as $bot)
                <tr wire:key="{{ $bot->id }}" class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 text-sm text-gray-500 font-mono">#{{ $bot->id }}</td>
                    <td class="p-3">
                        <div class="text-sm font-medium text-gray-900">{{ $bot->first_name }} {{ $bot->last_name }}</div>
                    </td>
                    <td class="p-3 text-sm">
                        <a href="https://t.me/{{ $bot->username }}" target="_blank" class="text-blue-600 hover:underline">
                            @ {{ $bot->username }}
                        </a>
                    </td>
                    <td class="p-3 text-center">
                        {{ $bot->secureData->bot_token }}
                    </td>
                    <td class="p-3 text-center">
                        {{ $bot->secureData->api_key }}
                    </td>
                    <td class="p-3 text-sm text-gray-500 text-right">
                        {{ $bot->created_at?->format('d.m.Y H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-400">
                        Боты не найдены по запросу "{{ $search }}"
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $bots->links('components/paginator', ['pagiAdditionalUri' => '']) }}
    </div>
</div>
