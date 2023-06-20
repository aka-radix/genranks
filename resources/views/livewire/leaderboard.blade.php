<div class="px-4 py-8 bg-white dark:bg-gray-800 sm:px-6 lg:px-8">
    <h2 class="mb-4 text-2xl font-semibold">Leaderboard</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <!-- Table headers -->
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        ELO</th>
                    <th
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        Rank</th>
                    <th
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        Nickname</th>
                    <th
                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                        Games Played</th>
                </tr>
            </thead>

            <!-- Table body -->
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                @forelse ($leaderboard as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->elo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->rank }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->nickname }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->games_played }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">No users on the leaderboard.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Display pagination links -->
    <div class="mt-4">
        {{ $leaderboard->links() }}
    </div>
</div>
