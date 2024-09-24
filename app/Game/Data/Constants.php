<?php

namespace App\Game\Data;

class Constants
{
    // Game States
    const GAME_STATE_NOT_INITIALIZED = 0;
    const GAME_STATE_IN_PROGRESS = 1;
    const GAME_STATE_ENDED = 2;


    // Game Modes
    const GAME_MODE_SANDBOX = 0;
    const GAME_MODE_FRIENDLY_DUEL = 1;
    const GAME_MODE_LLAMA_MAZE = 3;
    const GAME_MODE_COMPETITIVE_6 = 6;
    const GAME_MODE_COMPETITIVE_7 = 7;


    // Tiles
    const TILE_BLANK = 0;
    const TILE_EXIT = 2;
    const TILE_ENERGY_REGENERATOR = 4;
    const TILE_ARMOR_REGENERATOR = 5;
    const TILE_HITPOINT_REGENERATOR = 6;

}
