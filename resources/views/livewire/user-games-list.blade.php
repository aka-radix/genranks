<div>
    <div class="flex items-center justify-between">
        <h4 class="text-xl font-bold text-gray-900 dark:text-white">Games Played ({{ $user->games->count() }})</h4>
    </div>

    @forelse ($user->games as $game)
        <div
            class="grid grid-cols-2 gap-8 mt-8 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8">
            <a href="#"
                class="flex flex-col items-center justify-center text-gray-800 dark:text-gray-200 hover:text-blue-600">
                <img src="https://vojislavd.com/ta-template-demo/assets/img/connections/connection1.jpg"
                    class="w-16 rounded-full">
                <p class="mt-1 text-sm font-bold text-center">{{ $game->opponent->nickname }}</p>
                <p class="text-xs text-center text-gray-500 dark:text-gray-400">{{ $game->map }}</p>
            </a>
        </div>
    @empty
        <p class="text-xs text-gray-500 dark:text-gray-400">The user has not played a game yet!</p>
    @endforelse
</div>
