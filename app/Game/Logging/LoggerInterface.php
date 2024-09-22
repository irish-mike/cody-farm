<?php

namespace App\Game\Logging;

interface LoggerInterface
{
    public function info(string $message): void;
    public function error(string $message): void;
}
