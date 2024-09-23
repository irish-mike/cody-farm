<?php

namespace App\Game\Strategies;

use App\Game\Game;
use App\Game\Constants;
use App\Game\Map\Tile;

//TODO - The logic for finding the exit path should be handled in a separate class
class MoveStrategy implements StrategyInterface
{
    public function execute(Game $game): array
    {
        $bot = $game->getBot();
        $position = $bot->getPosition();

        $tile = new Tile();
        $tile->setPosition($position);

        $nextMoveToExit = $this->getNextMoveToExit($game->getMap(), $tile);

        if (!empty($nextMoveToExit))
            return $nextMoveToExit;

        return $this->makeRandomMove($bot->getPossibleMoves());
    }

    private function getNextMoveToExit(array $map, Tile $position): array
    {
        $pathToExit = $this->findShortestPath($map, $position);

        if (!empty($pathToExit) && isset($pathToExit[1])) {
            $nextTile = $pathToExit[1];
            return $nextTile->getPosition();
        }

        return [];
    }

    private function findShortestPath(array $map, Tile $start): array
    {
        $queue = [];
        $queue[] = [$start];
        $visited = [];
        $visited[$start->getX()][$start->getY()] = true;

        while (!empty($queue)) {
            $path = array_shift($queue);
            $currentTile = end($path);

            if ($currentTile->isExit()) {
                return $path;
            }

            $this->processNeighbors($queue, $path, $currentTile, $map, $visited);
        }

        return [];
    }

    private function processNeighbors(array &$queue, array $path, Tile $currentTile, array $map, array &$visited): void
    {
        $neighbors = $this->getNeighbors($map, $currentTile, $visited);

        foreach ($neighbors as $neighbor) {
            $visited[$neighbor->getX()][$neighbor->getY()] = true;
            $newPath = array_merge($path, [$neighbor]);
            $queue[] = $newPath;
        }
    }

    private function getNeighbors(array $map, Tile $tile, array $visited): array
    {
        $neighbors = [];

        $directions = [
            [0, 1],  // Right
            [1, 0],  // Down
            [0, -1], // Left
            [-1, 0], // Up
        ];

        foreach ($directions as $direction) {
            $neighbor = $this->getNeighborTile($map, $tile, $direction);

            if ($neighbor && $this->isValidNeighbour($neighbor, $visited)) {
                $neighbors[] = $neighbor;
            }
        }

        return $neighbors;
    }

    private function isValidNeighbour(Tile $neighbor, array $visited): bool
    {
        $x = $neighbor->getX();
        $y = $neighbor->getY();

        return !isset($visited[$x][$y]) && $neighbor->isWalkable();
    }

    private function getNeighborTile(array $map, Tile $tile, array $direction): ?Tile
    {
        // Calculate the new coordinates
        $x = $tile->getX() + $direction[0];
        $y = $tile->getY() + $direction[1];

        // Check if the new position exists in the map
        if (isset($map[$x][$y])) {
            $pos = $map[$x][$y]['position'];
            return new Tile($pos['x'], $pos['y'], $map[$x][$y]['type']);
        }

        return null;
    }

    private function makeRandomMove(array $possibleMoves): array
    {
        $randomIndex = array_rand($possibleMoves);
        return $possibleMoves[$randomIndex];
    }
}
