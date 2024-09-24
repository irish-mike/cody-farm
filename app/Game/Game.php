<?php

namespace App\Game;

use App\Game\Bots\BotInterface;
use App\Game\Data\Constants;
use App\Game\Logging\LoggerInterface;
use App\Game\Services\GameRequestService;
use App\Game\Strategies\StrategyManager;
use Illuminate\Support\Facades\Config;
use RuntimeException;

class Game
{
    private int $status = Constants::GAME_STATE_NOT_INITIALIZED;
    private array $map = [];
    private GameRequestService $gameRequestService;
    private BotInterface $bot;
    private LoggerInterface $log;
    private StrategyManager $strategyManager;

    public function __construct(
        LoggerInterface $log,
        GameRequestService $gameRequestService,
        BotInterface $bot,
    ) {
        $this->gameRequestService = $gameRequestService;
        $this->log = $log;
        $this->bot = $bot;

        // This may be better moved to the bot class
        $this->strategyManager = new StrategyManager();
    }

    public function play(): void
    {
        try {
            $this->initialize();
            $this->run();
        } catch (RuntimeException $e) {
            $this->log->error('An error occurred during the game: ' . $e->getMessage());
        } finally {
            $this->end();
        }
    }

    public function getMap(): array
    {
        // TODO - This should be encapsulated in a Map class
        return $this->map;
    }

    public function getBot(): BotInterface
    {
        return $this->bot;
    }

    private function initialize(): void
    {
        $this->waitForGameToStart();
    }

    private function waitForGameToStart(): void
    {
        $timeout = Config::get('services.game.matchmaking_timeout', 300);
        $pollingInterval = Config::get('services.game.polling_interval', 2);
        $elapsedTime = 0;

        while ($this->isStarting()) {
            $this->updateGameState();
            $elapsedTime += $pollingInterval;
            $this->checkTimeout($elapsedTime, $timeout);
            sleep($pollingInterval);

            $this->log->info("Waiting for matchmaking... ({$elapsedTime}s)");
        }

        $this->log->info("Game is now in progress.");
    }

    private function run(): void
    {
        $pollingInterval = Config::get('services.game.polling_interval', 2);

        while ($this->inProgress()) {
            $this->handleTakeTurn();
            $this->updateGameState();
            sleep($pollingInterval);
        }
    }

    private function handleTakeTurn(): void
    {
        if (!$this->bot->isTurn()) {
            return;
        }

        if ($move = $this->strategyManager->getMoveParams($this)) {
            $this->gameRequestService->move($move['x'], $move['y']);
        }

        if ($cast = $this->strategyManager->getCastParams($this)) {
            $this->gameRequestService->castSkill($cast['skill_id'], $cast['x'], $cast['y']);
        }
    }

    private function end(): void
    {
        $this->status = Constants::GAME_STATE_ENDED;
        $this->log->info("Game ended.");
    }

    private function inProgress(): bool
    {
        return $this->status === Constants::GAME_STATE_IN_PROGRESS;
    }

    private function isStarting(): bool
    {
        return $this->status === Constants::GAME_STATE_NOT_INITIALIZED;
    }

    private function checkTimeout(int $elapsedTime, int $timeout): void
    {
        if ($elapsedTime >= $timeout) {
            throw new RuntimeException('Matchmaking timeout: game did not start in time.');
        }
    }

    private function syncGameState(array $stateData): void
    {
        $this->updateState($stateData['state']['status']);
        $this->updatePlayers($stateData['players']);
        $this->updateMap($stateData['map']);
    }

    private function updateState(int $status): void
    {
        $this->status = $status;
    }

    private function updatePlayers(array $players): void
    {
        $this->bot->setState($players['bearer']);
    }

    private function updateMap(array $map): void
    {
        $this->map = $map;
    }

    private function updateGameState(): void
    {
        $updatedState = $this->gameRequestService->checkState();
        $this->syncGameState($updatedState);
    }
}
