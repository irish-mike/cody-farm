<?php

namespace App\Game\Strategies;

use App\Game\Game;

interface StrategyInterface
{
    public function execute(Game $game): array;
}
