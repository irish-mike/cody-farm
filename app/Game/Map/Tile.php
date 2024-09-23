<?php

namespace App\Game\Map;
use App\Game\Data\Constants;

class Tile
{
    private int $type;
    private int $x;
    private int $y;

    public function __construct($x = 0, $y = 0, $type = Constants::TILE_BLANK)
    {
        $this->x = $x;
        $this->y = $y;
        $this->type = $type;
    }

    public function setType(int $type): void
    {
        $this->type = $type;
    }

    public function setPosition(array $position): void
    {
        $this->x = $position['x'];
        $this->y = $position['y'];
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getPosition(): array
    {
        return ['x' => $this->x, 'y' => $this->y];
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function isWalkable(): bool
    {
        return in_array($this->type, [
            Constants::TILE_BLANK,
            Constants::TILE_ENERGY_REGENERATOR,
            Constants::TILE_ARMOR_REGENERATOR,
            Constants::TILE_HITPOINT_REGENERATOR,
            Constants::TILE_EXIT,
        ]);
    }

    public function isExit(): bool
    {
        return $this->type === Constants::TILE_EXIT;
    }

    public function equals(Tile $tile): bool
    {
        return $this->x === $tile->getX() && $this->y === $tile->getY();
    }
}
