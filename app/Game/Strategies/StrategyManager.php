<?php

namespace App\Game\Strategies;

use App\Game\Game;
use App\Game\Bots\BotInterface;  // Use BotInterface here

class StrategyManager
{
    private MoveStrategy $moveStrategy;
    private CastStrategy $castStrategy;

    public function __construct()
    {
        $this->moveStrategy = new MoveStrategy();
        $this->castStrategy = new CastStrategy();
    }

    public function getMoveParams(Game $game): array
    {
        return $this->moveStrategy->execute($game);
    }

    public function getCastParams(Game $game): array
    {
        return $this->castStrategy->execute($game);
    }
}
