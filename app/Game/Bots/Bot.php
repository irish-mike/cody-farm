<?php

namespace App\Game\Bots;

class Bot implements BotInterface
{
    private array $position;
    private array $possibleMoves;
    private bool $isPlayerTurn;

    public function __construct(array $position, array $possibleMoves, bool $isPlayerTurn)
    {
        $this->position = $position;
        $this->possibleMoves = $possibleMoves;
        $this->isPlayerTurn = $isPlayerTurn;
    }

    public function setPlayerState(array $player): void
    {
        $this->position = $player['position'] ?? [];
        $this->possibleMoves = $player['possible_moves'] ?? [];
        $this->isPlayerTurn = $player['is_player_turn'] ?? false;
    }

    public function takeTurn(): void
    {
        if (!$this->isPlayerTurn) {
            throw new RuntimeException('It is not the player’s turn.');
        }

        $this->castSkill();
        $this->makeMove();
    }

    public function isPlayerTurn(): bool
    {
        return $this->isPlayerTurn;
    }

    protected function castSkill(): void
    {
        throw new RuntimeException('Brute: castSkill() is not implemented yet.');
    }

    protected function makeMove(): void
    {
        throw new RuntimeException('Brute: makeMove() is not implemented yet.');
    }
}
