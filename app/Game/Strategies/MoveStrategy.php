<?php

namespace App\Game\Strategies;

use App\Game\Game;
use App\Game\Bots\BotInterface;  // Use BotInterface here

class MoveStrategy implements StrategyInterface
{
    public function execute(Game $game, BotInterface $bot): array
    {
        return $this->makeRandomMove($bot->getPossibleMoves());
    }

    private function makeRandomMove(array $possibleMoves): array
    {
        $randomIndex = array_rand($possibleMoves);
        return $possibleMoves[$randomIndex];
    }

}
