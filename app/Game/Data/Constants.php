<?php

namespace App\Game\Data;

class Constants
{
    // Game States
    const GAME_STATE_NOT_INITIALIZED = 0;
    const GAME_STATE_PLAYERS_REGISTERING = 1;
    const GAME_STATE_IN_PROGRESS = 2;
    const GAME_STATE_ENDED = 3;

    // Verdicts
    const VERDICT_DRAW = 0;
    const VERDICT_BASED_ON_POINTS = 1;
    const VERDICT_BASED_ON_RYO_COUNT = 2;
    const VERDICT_TURN_TIMEOUT = 3;
    const VERDICT_MATCHMAKING_TIMEOUT = 4;
    const VERDICT_PLAYER_SURRENDERED = 5;
    const VERDICT_PLAYER_DEMOLISHED = 6;
    const VERDICT_GAME_TIMEOUT = 7;
    const VERDICT_GAME_CANCELLED = 8;

    // Game Modes
    const GAME_MODE_SANDBOX = 0;
    const GAME_MODE_FRIENDLY_DUEL = 1;
    const GAME_MODE_LLAMA_MAZE = 3;
    const GAME_MODE_COMPETITIVE_6 = 6;
    const GAME_MODE_COMPETITIVE_7 = 7;

}
