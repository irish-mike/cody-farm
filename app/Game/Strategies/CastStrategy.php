<?php

namespace App\Game\Strategies;

use App\Game\Bots\BotInterface;
use App\Game\Game;

class CastStrategy implements StrategyInterface
{
    public function execute(Game $game): array
    {
        $bot = $game->getBot();
        if ($bot->hasAvailableTargets()) {
            $availableTargets = $bot->getAvailableTargets();
            $skills = $bot->getSkills();

            foreach ($skills as $skill) {
                if ($bot->skillReady($skill)) {
                    $target = $availableTargets[0];
                    echo "Casting skill {$skill['id']} on x: {$target['x']} y: {$target['y']}\n";
                    return [
                        'skill_id' => $skill['id'],
                        'x' => $target['x'],
                        'y' => $target['y']
                    ];
                }
            }
        }

        return [];
    }
}
