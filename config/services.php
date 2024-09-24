<?php

return [
    'game' => [
        'ckey' => env('GAME_CKEY'),
        'api_url' => env('GAME_API_URL', 'https://game.codyfight.com'),
        'matchmaking_timeout' => env('GAME_MATCHMAKING_TIMEOUT', 300),
        'polling_interval' => env('GAME_POLLING_INTERVAL', 2),
    ],
];

