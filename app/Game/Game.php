<?php

namespace App\Game;

use App\Game\Bots\BotInterface;
use App\Game\Data\Constants;
use App\Game\Services\GameRequestService;
use App\Game\Logging\LoggerInterface;
use App\Game\Strategies\StrategyManager;
use RuntimeException;

// TODO: Connect to the game api

// TODO: Implement BFS algorithm for finding exit
// TODO: Review and refactor code

class Game
{
    private int $status = Constants::GAME_STATE_NOT_INITIALIZED;
    private array $map = [];
    private GameRequestService $gameRequestService;
    private BotInterface $bot;
    private LoggerInterface $output;

    private StrategyManager $strategyManager;

    public function __construct(GameRequestService $gameRequestService, LoggerInterface $output, BotInterface $bot)
    {
        $this->gameRequestService = $gameRequestService;
        $this->output = $output;
        $this->bot = $bot;

        $this->strategyManager = new StrategyManager();
    }

    public function play(): void
    {
        try{
            $this->initialize();
            $this->run();
        } catch (RuntimeException $e) {
            $this->output->error($e->getMessage());
        } finally {
            $this->end();
        }
    }

    // Core Game Flow
    private function initialize(): void
    {
        $config = $this->gameRequestService->init(Constants::GAME_MODE_FRIENDLY_DUEL);
        $this->syncGameState($config);
        $this->waitForGameToStart();
    }

    private function waitForGameToStart(): void
    {
        $timeout = 300;
        $pollingInterval = 2;
        $elapsedTime = 0;

        while ($this->isStarting()) {
            $this->checkTimeout($elapsedTime, $timeout);

            sleep($pollingInterval);
            $elapsedTime += $pollingInterval;

            $this->updateGameState();

            $this->output->info("Waiting for matchmaking... ({$elapsedTime}s)");
        }

        $this->output->info("Game is now in progress.");
    }

    private function run(): void
    {
        while ($this->inProgress()) {
            $this->handleTakeTurn();
            $this->updateGameState();
        }
    }

    private function handleTakeTurn(): void
    {
        if (!$this->bot->isTurn())
            return;

        $move = $this->strategyManager->getMoveParams($this, $this->bot);
        $cast = $this->strategyManager->getCastParams($this, $this->bot);

        $this->bot->setPosition($move);

        if(!empty($cast)) {
            $this->gameRequestService->castSkill($cast['skill_id'], $cast['x'], $cast['y']);
        }

        $this->gameRequestService->move($move['x'], $move['y']);

    }

    private function end(): void
    {
        $this->status === Constants::GAME_STATE_ENDED;
        $this->output->info("Game ended.");
    }

    // State Management
    private function inProgress(): bool
    {
        return $this->status === Constants::GAME_STATE_IN_PROGRESS;
    }

    private function isStarting(): bool
    {
        return $this->status === Constants::GAME_STATE_NOT_INITIALIZED || $this->status === Constants::GAME_STATE_PLAYERS_REGISTERING;
    }

    private function checkTimeout(int $elapsedTime, int $timeout): void
    {
        if ($elapsedTime >= $timeout) {
            throw new RuntimeException('Matchmaking timeout: game did not start in time.');
        }
    }

    // Syncing State
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
