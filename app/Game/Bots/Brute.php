<?php
namespace App\Game\Bots;
class Brute extends Bot {
    public function __construct(array $position, array $possibleMoves, bool $isPlayerTurn)
    {
        parent::__construct($position, $possibleMoves, $isPlayerTurn);
    }
}
