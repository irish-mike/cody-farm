<?php

namespace App\Game\Bots;

class Bot implements BotInterface
{
    private array $position = [];
    private array $possibleMoves = [];
    private array $skills = [];
    private bool $isPlayerTurn = false;

    public function setState(array $player): void
    {
        if(empty($this->position)) {
            $this->position = $player['position'] ?? [];
        }

        $this->possibleMoves = $player['possible_moves'] ?? [];
        $this->skills = $player['skills'] ?? [];
        $this->isPlayerTurn = $player['is_player_turn'] ?? false;
    }

    public function getPossibleMoves(): array
    {
        return $this->possibleMoves;
    }

    public function getPosition(): array
    {
        return $this->position;
    }

    public function setPosition(array $position): void
    {
        $this->position = $position;
    }

    public function isTurn(): bool
    {
        return $this->isPlayerTurn;
    }

    public function getSkills(): array
    {
        return $this->skills;
    }

    public function skillReady(array $skill): bool
    {
        return $skill['cooldown'] === 0 && !empty($skill['possible_targets']);
    }
    public function getAvailableTargets(): ?array
    {
        foreach ($this->skills as $skill) {
            if ($this->skillReady($skill)) {
                return $skill['possible_targets'];
            }
        }
        return null;
    }

    public function hasAvailableTargets(): bool
    {
        return $this->getAvailableTargets() !== null;
    }
}
