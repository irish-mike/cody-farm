<?php

namespace App\Game\Strategies;

use App\Game\Map\Tile;

class PathFinder
{
    private array $map;
    private Tile $startTile;
    private array $visited = [];
    private array $possibleMoves = [];
    private array $queue = [];

    public function __construct(array $map, Tile $startTile, array $possibleMoves)
    {
        $this->map = $map;
        $this->startTile = $startTile;
        $this->possibleMoves = $possibleMoves;
    }

    public function findShortestPathToExit(): array
    {
        $this->queue[] = [$this->startTile];
        $this->visited[$this->startTile->getX()][$this->startTile->getY()] = true;

        while (!empty($this->queue)) {
            $path = array_shift($this->queue);
            $currentTile = end($path);

            if ($currentTile->isExit()) {
                return $path;
            }

            $neighbors = $this->getNeighbors($currentTile);

            foreach ($neighbors as $neighbor) {
                $x = $neighbor->getX();
                $y = $neighbor->getY();

                if (!isset($this->visited[$x][$y]) && $neighbor->isWalkable() && $this->isPossibleMove($neighbor)) {
                    $this->visited[$x][$y] = true;
                    $newPath = $path;
                    $newPath[] = $neighbor;
                    $this->queue[] = $newPath;
                }
            }
        }

        return [];
    }

    private function getNeighbors(Tile $tile): array
    {
        $neighbors = [];
        $directions = [
            [0, 1],   // Right
            [1, 0],   // Down
            [0, -1],  // Left
            [-1, 0],  // Up
        ];

        foreach ($directions as $direction) {
            $neighborTile = $this->getNeighborTile($tile, $direction);
            if ($neighborTile !== null) {
                $neighbors[] = $neighborTile;
            }
        }

        return $neighbors;
    }

    private function getNeighborTile(Tile $tile, array $direction): ?Tile
    {
        $x = $tile->getX() + $direction[0];
        $y = $tile->getY() + $direction[1];

        if (isset($this->map[$x][$y])) {
            $tileData = $this->map[$x][$y];
            return new Tile($x, $y, $tileData['type']);
        }

        return null;
    }

    private function isPossibleMove(Tile $tile): bool
    {
        foreach ($this->possibleMoves as $move) {
            if ($move['x'] === $tile->getX() && $move['y'] === $tile->getY()) {
                return true;
            }
        }
        return false;
    }
}
