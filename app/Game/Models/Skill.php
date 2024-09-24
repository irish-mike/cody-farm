<?php

namespace App\Game\Models;

class Skill
{
    public int $id;
    public string $name;
    public int $cooldown;
    public int $cost;
    public array $possibleTargets;

    public function __construct(array $skillData)
    {
        $this->id = $skillData['id'];
        $this->name = $skillData['name'];
        $this->cooldown = $skillData['cooldown'];
        $this->cost = $skillData['cost'];
        $this->possibleTargets = $skillData['possible_targets'] ?? [];
    }

    public function isReady(): bool
    {
        return $this->cooldown === 0;
    }

    public function hasTargets(): bool
    {
        return !empty($this->possibleTargets);
    }

    public function getTargets(): array
    {
        return $this->possibleTargets;
    }

    public function getRandomTarget(): array
    {
        return $this->possibleTargets[array_rand($this->possibleTargets)];
    }

    public function canCast(int $energy): bool
    {
        return $this->isReady() && $energy >= $this->cost && $this->hasTargets();
    }
}
