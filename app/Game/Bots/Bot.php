<?php

namespace App\Game\Bots;

class Bot implements BotInterface{

    public function __construct()
    {
        echo 'Bot created';
    }
    public function takeTurn(): void
    {
        $this->castSkill();
        $this->makeMove();
    }

    protected function castSkill(): void
    {
        throw new RuntimeException('Brute: castBestSkill() is not implemented yet.');
    }

    protected function makeMove(): void
    {
        throw new RuntimeException('Brute: makeBestMove() is not implemented yet.');
    }
}
