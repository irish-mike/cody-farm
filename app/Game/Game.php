<?php

namespace App\Game;

use App\Game\Bots\BotInterface;
use App\Game\Bots\Brute;
use App\Game\Data\Constants;
use App\Game\Services\GameRequestService;
use RuntimeException;

class Game
{
    private int $state;
    private GameRequestService $gameRequestService;
    private BotInterface $bot;

    public function __construct(GameRequestService $gameRequestService)
    {
        $this->gameRequestService = $gameRequestService;
        $this->bot = new Brute(); //TODO implement bot selection
        $this->state = Constants::GAME_STATE_NOT_INITIALIZED;
    }

    public function play()
    {
        // initialize the game
        // run main loop
        // end the game and tidy up
        throw new RuntimeException('Game: play() is not implemented yet.');
    }

    public function endGame(): void
    {
        $this->setState(Constants::GAME_STATE_ENDED);
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function setState(int $state): void
    {
        $this->state = $state;
    }

    private function initialize(): void
    {
        throw new RuntimeException('Game: initialize() is not implemented yet.');
    }

    private function run(): int
    {
        while ($this->inProgress()) {

            if ($this->isPlayerTurn()) {
                $this->bot->takeTurn();
            }

            $this->setState($this->gameRequestService->checkState());
        }
    }

    private function end(): void
    {
        throw new RuntimeException('Game: end() is not implemented yet.');
    }

    private function isPlayerTurn(): bool
    {
        // $this->state...
        return true; // TODO implement this
    }

    private function inProgress(): bool
    {
        return $this->state === Constants::GAME_STATE_IN_PROGRESS;
    }

}
