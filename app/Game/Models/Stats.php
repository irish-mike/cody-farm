<?php

namespace App\Game\Models;

class Stats
{
    public int $energy;

    public function __construct(array $statsData)
    {
        $this->energy = $statsData['energy'] ?? 0;
    }

    public function getEnergy(): int
    {
        return $this->energy;
    }
}
