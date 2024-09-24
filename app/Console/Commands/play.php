<?php

namespace App\Console\Commands;

use App\Game\Bots\Brute;
use App\Game\Data\Constants;
use App\Game\Game;
use App\Game\Logging\ConsoleLogger;
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
    protected $description = 'Starts the game';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $logger = new ConsoleLogger($this);
        $logger->info('Starting game...');

        try {
            $logger->info('Creating GameRequestService...');
            $service = new GameRequestService($logger);

            $logger->info('Initializing game...');

            if (! ($config = $service->init(Constants::GAME_MODE_SANDBOX))) {
                throw new \Exception('Failed to initialize game');
            }

            $logger->info('Creating Brute bot...');
            $bot = new Brute();

            $logger->info('Creating Game...');
            $game = new Game($logger, $service, $bot);

            $logger->info('Playing game...');
            $game->play();

            $logger->info('Game ended.');
        } catch (\Exception $e) {
            $logger->error('An error occurred: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
