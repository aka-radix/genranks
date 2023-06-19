<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch GenTool data here, and parse it into the game and user system!

        $this->info('Fetched data from GenTool!');
    }
}
