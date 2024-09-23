<?php

namespace App\Game\Strategies;

use App\Game\Bots\BotInterface;
use App\Game\Game;

interface StrategyInterface
{
    public function execute(Game $game): array;
}
