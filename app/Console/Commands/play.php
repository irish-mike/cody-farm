<?php

namespace App\Console\Commands;

use App\Game\Game;
use App\Game\Services\GameRequestService;
use Illuminate\Console\Command;

class play extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting game...');

        try {
            $this->info('Creating GameRequestService...');
            $service = new GameRequestService();

            $this->info('Creating Game...');
            $game = new Game($service);

            $this->info('Playing game...');
            $game->play();

            $this->info('Game ended.');
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            Log::error('Game error: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
