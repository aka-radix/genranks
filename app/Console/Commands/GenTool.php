<?php

namespace App\Console\Commands;

use App\Events\GameCompleted;
use App\Models\Game;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GenTool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gentool:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch GenTool data since the last time. First run does nothing.';

    protected const BASE_URL = "https://www.gentool.net/data/zh";
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching data from GenTool!');

        $fullURL = $this->combineURL();
        $users = $this->getUserURLS($fullURL);

        // All .txt files are game info files
        // The file names are time, then mode, then players, example: 12-31-07_1v1_owl_Pin.txt
        // Seconds can be a bit off...
        foreach ($users as $nickname => $url) {
            $this->info('Fetching from user: ' . $nickname);

            // Check if user exists and create them
            $user = $this->createUserIfNotExists($nickname);

            $games = $this->getGameLinks($url);

            // Add all games found for user
            foreach ($games as $gameName => $gameUrl) {
                // Check the hash don't exist, and create the game
                $game = $this->createGameIfNotExists($gameName, $gameUrl, $fullURL);
                // If the game already have users equial to the game mode, then do nothing
                // If the game exists, add the user to it

                // This means the game is ended and should not do anything with it.
                $this->attachUserToGame($user, $game);
                $this->info('Game added: ' . $gameName);
            }
        }

        $this->info('Data fetching done!');
    }

    /**
     * Get the user URLs from the provided full URL.
     *
     * @param string $fullURL The full URL to retrieve user URLs from.
     * @return \Illuminate\Support\Collection The collection of user URLs.
     */
    private function getUserURLs(string $fullURL): \Illuminate\Support\Collection
    {
        // Get all links on that page, which are the nicknames of the users
        $response = Http::get($fullURL);
        $lines = explode(PHP_EOL, $response->getBody());
        $usersCollection = collect();
        foreach ($lines as $line) {
            $link = $this->getStringBetween($line, 'src="/icons/folder-icon.png" alt="[DIR]"></td><td><a href="', '/">');
            if ($link == "")
                continue;

            $name = $this->getStringBetween($line, $link . '/">', '/</a></td><td align="right">');
            $usersCollection->put($name, $fullURL . '/' . $link);
        }

        return $usersCollection;
    }

    /**
     * Get the game links for a user.
     *
     * @param string $userUrl The URL of the user.
     * @return \Illuminate\Support\Collection The collection of game links.
     */
    private function getGameLinks(string $userUrl): \Illuminate\Support\Collection
    {
        $response = Http::get($userUrl);
        $lines = explode(PHP_EOL, $response->getBody());
        $gamesCollection = collect();
        foreach ($lines as $line) {
            $matchName = $this->getStringBetween($line, 'trophy.png" alt="[REP]"></td><td><a href="', '.rep">');
            if ($matchName == "")
                continue;

            $gamesCollection->put($matchName, $userUrl . '/' . $matchName);
        }

        return $gamesCollection;
    }

    /**
     * Combine the base URL with the formatted date.
     *
     * @return string The combined URL.
     */
    private function combineURL(): string
    {
        return $this::BASE_URL . '/' . Date::now()->format('Y_m_F/d_l');
    }

    /**
     * Get the string between two given substrings.
     *
     * @param string $string The input string.
     * @param string $start The starting substring.
     * @param string $end The ending substring.
     * @return string The string between the start and end substrings.
     */
    private function getStringBetween(string $string, string $start, string $end): string
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;

        return substr($string, $ini, $len);
    }

    /**
     * Check if a user exists and create them if not using a factory.
     *
     * @param  string  $nickname
     * @return User
     */
    function createUserIfNotExists(string $nickname): User
    {
        $user = User::where('nickname', $nickname)->first();

        if (!$user) {
            // User does not exist, create them
            $user = User::create([
                'nickname' => $nickname,
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make(Str::random(25, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#%!-_?+')),
            ]);
        }

        return $user;
    }

    private function attachUserToGame(User $user, Game $game)
    {
        // If the game already have all players linked
        if ($game->verified) {
            return false;
        }

        // Check if the game has the user
        if (!$game->users->contains($user)) {
            // Attach the user to the game if they are not already attached
            $game->users()->attach($user);
        }
        
        // Check the number of users attached to the game
        // Compare the attached user count with the player count
        if ($game->users()->count() >= $game->player_count) {
            // The required number of players is reached
            // TODO: Actually find the real winner!

            // Randomly select a winner from the connected users
            $winner = $game->users()->inRandomOrder()->first();
            $game->update([
                'winner_id' => $winner->id,
                'verified' => true,
            ]);
            event(new GameCompleted($game));
        }
    }

    /**
     * Check if a game exists based on the hash and create one if it doesn't.
     *
     * @param string $hash The hash of the game.
     * @return Game The existing or newly created game.
     */
    private function createGameIfNotExists($name, $gameURL, $todaysURL): Game
    {
        // Get data from links and names
        $nameSplit = explode('_', $name);

        $timeStarted = $nameSplit[0];
        $mode = $nameSplit[1];
        $players = collect(array_slice($nameSplit, 2));
        $txt = $gameURL . '.txt';
        $replay = $gameURL . '.rep';

        // Make game hash
        $data = $timeStarted . $mode . $players->implode('_') . $txt . $replay . $todaysURL;
        $hash = md5($data);

        // Create or fetch game
        $game = Game::where('hash', $hash)->first();
        if ($game === null) {
            // Game does not exist, create a new one
            $game = Game::create([
                'hash' => $hash,
                'player_count' => $players->count(),
                'mode' => $mode,
            ]);
        }

        return $game;
    }
    
}
