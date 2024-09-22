<?php

namespace App\Game\Logging;

use Illuminate\Console\Command;

class ConsoleLogger implements LoggerInterface
{
    private Command $console;

    public function __construct(Command $console)
    {
        $this->console = $console;
    }

    public function info(string $message): void
    {
        $this->console->info($message);
    }

    public function error(string $message): void
    {
        $this->console->error($message);
    }
}
