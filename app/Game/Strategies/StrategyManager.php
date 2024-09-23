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

    public function getMoveParams(Game $game, BotInterface $bot): array
    {
        return $this->moveStrategy->execute($game, $bot);
    }

    public function getCastParams(Game $game, BotInterface $bot): array
    {
        return $this->castStrategy->execute($game, $bot);
    }
}
