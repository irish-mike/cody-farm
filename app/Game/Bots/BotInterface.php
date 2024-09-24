<?php

namespace App\Game\Bots;

use App\Game\Models\Position;
use App\Game\Models\Skill;
use App\Game\Models\Stats;

interface BotInterface
{
    public function setState(array $player): void;

    public function getPossibleMoves(): array;

    public function getPosition(): Position;

    public function isTurn(): bool;

    public function getSkills(): array;

    public function getStats(): Stats;

}
