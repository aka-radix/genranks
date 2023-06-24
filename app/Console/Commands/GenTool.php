<?php

namespace App\Console\Commands;

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

            // Check if user exists and create them
            $user = $this->createUserIfNotExists($nickname);

            $games = $this->getGameLinks($url);
            dump($nickname);
            dump($url);

            foreach ($games as $gameName => $gameUrl) {
                dump($gameName);
                dump($gameUrl);
                $gameHash = $this->generateGameHash($gameName, $gameUrl);
            }
            dd('Looped over all the users games now!');
        }

        // Check the hash don't exist, and create the game
        //$gameFound = Game::whereNot('hash', $gameHash)->first();

        if ($gameFound != null) {
            // If the game already have users equial to the game mode, then do nothing
            // If the game exists, add the user to it
        }

        // When adding the game to a user also add the file name to the game
        // so we can see we don't have to fetch that .txt file next fetch in the same day!

        // If the game has the same amount of players as the mode after adding the last player
        // Then we find the winner with the replays
    }

    private function generateGameHash($name, $gameUrl): string
    {
        $txt = $gameUrl . '.txt';
        $replay = $gameUrl . '.rep';
        // Make a unique hash for the game involving the .txt file name, without the time, and the date/day
        // and the following info:
        // Map Name:         maps/[rank] td nobugscars zh v1
        // Start Cash:       10000
        // Match Type:       1v1
        // Match Length:     00:08:09
        // Match Mode:       LAN

        // No Team
        //     1AB72000 owl (Random)
        //     1AFE3000 Pin (Random)
        return 'test';
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
        dump($nickname);
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
    
}
