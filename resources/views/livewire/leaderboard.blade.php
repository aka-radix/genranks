<div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="items-center py-4 mx-1 md:justify-between md:flex">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <x-icon icon='search' class="dark:text-gray-200" />
                </div>
                <input wire:model.debounce="search" type="text" id="table-search"
                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg md:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for users" name="users">
            </div>
            <div>
                <x-gen-tool-timer
                    class="mt-4 text-xl font-semibold leading-tight text-gray-800 md:mt-0 dark:text-gray-200" />
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Rank
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nickname
                    </th>
                    <th scope="col" class="px-6 py-3">
                        ELO
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Games Played
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            {{ $user->rank }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ $user->route() }}">
                                {{ $user->nickname }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->elo }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->games_played }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($users->hasPages())
        {{ $users->links() }}
    @endif
</div>
