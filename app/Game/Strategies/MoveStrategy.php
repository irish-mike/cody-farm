<?php

namespace App\Game\Strategies;

use App\Game\Game;
use App\Game\Map\Tile;

class MoveStrategy implements StrategyInterface
{
    public function execute(Game $game): array
    {
        $bot = $game->getBot();
        $position = $bot->getPosition();
        $possibleMoves = $bot->getPossibleMoves();

        $tile = new Tile($position->x, $position->y);

        $pathFinder = new PathFinder($game->getMap(), $tile, $possibleMoves);
        $pathToExit = $pathFinder->findShortestPathToExit();

        if (!empty($pathToExit) && isset($pathToExit[1])) {
            $nextTile = $pathToExit[1];
            return [
                'x' => $nextTile->getX(),
                'y' => $nextTile->getY(),
            ];
        }

        return $this->makeRandomMove($possibleMoves);
    }

    private function makeRandomMove(array $possibleMoves): array
    {
        if (empty($possibleMoves)) {
            return [];
        }

        $randomIndex = array_rand($possibleMoves);
        return [
            'x' => $possibleMoves[$randomIndex]['x'],
            'y' => $possibleMoves[$randomIndex]['y'],
        ];
    }
}
