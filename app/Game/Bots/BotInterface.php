<?php

namespace App\Game\Bots;

interface BotInterface
{
    public function setState(array $player): void;

    public function getPossibleMoves(): array;

    public function getPosition(): array;

    public function setPosition(array $position): void;

    public function isTurn(): bool;

    public function getSkills(): array;

    public function skillReady(array $skill): bool;

    public function getAvailableTargets(): ?array;

    public function hasAvailableTargets(): bool;
}
