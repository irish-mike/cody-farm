<?php

namespace App\Game\Bots;

use App\Game\Models\Position;
use App\Game\Models\Skill;
use App\Game\Models\Stats;

class Bot implements BotInterface
{
    private Position $position;
    private array $skills = [];
    private Stats $stats;

    private array $possibleMoves = [];
    private bool $isPlayerTurn = false;

    public function setState(array $player): void
    {
        $this->setPosition($player);
        $this->setSkills($player);
        $this->setStats($player);
        $this->possibleMoves = $player['possible_moves'] ?? [];
        $this->isPlayerTurn = $player['is_player_turn'] ?? false;
    }

    private function setPosition(array $player): void
    {
        if (isset($player['position'])) {
            $positionData = $player['position'];
            $this->position = new Position($positionData['x'], $positionData['y']);
        }
    }

    private function setSkills(array $player): void
    {
        $this->skills = [];
        if (isset($player['skills'])) {
            foreach ($player['skills'] as $skillData) {
                $this->skills[] = new Skill($skillData);
            }
        }
    }

    private function setStats(array $player): void
    {
        $this->stats = new Stats($player['stats'] ?? []);
    }

    public function getPossibleMoves(): array
    {
        return $this->possibleMoves;
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function isTurn(): bool
    {
        return $this->isPlayerTurn;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function getStats(): Stats
    {
        return $this->stats;
    }
}
