<?php

namespace App\Game\Strategies;

use App\Game\Game;
use App\Game\Models\Skill;

class CastStrategy implements StrategyInterface
{
    public function execute(Game $game): array
    {
        $bot = $game->getBot();
        $energy = $bot->getStats()->getEnergy();
        $skills = $bot->getSkills();

        foreach ($skills as $skill) {
            if ($skill->canCast($energy)) {
                $target = $skill->getRandomTarget();

                return [
                    "skill_id" => $skill->id,
                    "x" => $target["x"],
                    "y" => $target["y"],
                ];
            }
        }

        return [];
    }
}
