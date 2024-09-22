<?php

namespace App\Game\Services;

use Illuminate\Support\Facades\Http;

// API Docs: https://codyfight.com/api-doc/
class GameRequestService
{
    protected string $ckey;
    protected string $apiUrl;

    public function __construct()
    {
        $this->ckey = 123;//env('CKEY');
        $this->apiUrl = "test.com"; //env('API_URL');
    }

    public function init(int $mode, string $opponent = null): array
    {
        return [
            'state' => [
                'id' => null,
                'status' => 0,
                'mode' => 0,
                'round' => null,
                'total_turns' => null,
                'total_rounds' => null,
                'max_turn_time' => null,
                'turn_time_left' => 0,
            ],
            'players' => [
                'bearer' => [
                    'name' => 'Foo',
                    'owner' => 'Codyfight',
                    'stats' => [],
                    'codyfighter' => [
                        'type' => 3,
                        'name' => 'Leon',
                        'class' => 'BRUTE',
                        'rarity' => 'LEGENDARY',
                    ],
                    'turn' => null,
                    'position' => null,
                    'possible_moves' => [],
                    'is_player_turn' => false,
                    'skills' => [],
                    'score' => [
                        'points' => 0,
                        'ryo_count' => 0,
                        'exit_count' => 0,
                        'kill_count' => 0,
                        'death_count' => 0,
                    ],
                ],
                'opponent' => [
                    'name' => null,
                    'owner' => null,
                    'stats' => [],
                    'codyfighter' => null,
                    'turn' => null,
                    'position' => null,
                    'possible_moves' => [],
                    'is_player_turn' => false,
                    'skills' => [],
                    'score' => [
                        'points' => 0,
                        'ryo_count' => 0,
                        'exit_count' => 0,
                        'kill_count' => 0,
                        'death_count' => 0,
                    ],
                ],
            ],
            'special_agents' => [],
            'map' => [],
            'verdict' => [
                'context' => 'game-not-initialized',
                'statement' => null,
                'winner' => null,
            ],
        ];
    }

    public function checkState(): array
    {
        return [
                "state" => [
                    "id" => 1,
                    "status" => 2,
                    "mode" => 0,
                    "round" => 0,
                    "total_turns" => 30,
                    "total_rounds" => 5,
                    "max_turn_time" => 60,
                    "turn_time_left" => 0
                ],
                "players" => [
                    "bearer" => [
                        "name" => "Foo",
                        "owner" => "Codyfight",
                        "stats" => [
                        ],
                        "codyfighter" => [
                            "type" => 3,
                            "name" => "Leon",
                            "class" => "BRUTE",
                            "rarity" => "LEGENDARY"
                        ],
                        "turn" => 14,
                        "position" => [
                            "x" => 5,
                            "y" => 6
                        ],
                        "possible_moves" => [
                        ],
                        "is_player_turn" => true,
                        "skills" => [
                        ],
                        "score" => [
                            "points" => 0,
                            "ryo_count" => 0,
                            "exit_count" => 0,
                            "kill_count" => 0,
                            "death_count" => 0
                        ],
                        "points" => 0
                    ],
                    "opponent" => [
                        "name" => "Bar",
                        "owner" => "Codyfight",
                        "stats" => [
                        ],
                        "codyfighter" => [
                            "type" => 1,
                            "name" => "Bar",
                            "class" => "ENGINEER",
                            "rarity" => "LEGENDARY"
                        ],
                        "turn" => 5,
                        "position" => [
                            "x" => 4,
                            "y" => 5
                        ],
                        "possible_moves" => [
                        ],
                        "is_player_turn" => false,
                        "skills" => [
                        ],
                        "score" => [
                            "points" => 0,
                            "ryo_count" => 0,
                            "exit_count" => 0,
                            "kill_count" => 0,
                            "death_count" => 0
                        ],
                        "points" => 0
                    ]
                ],
                "special_agents" => [
                    [
                        "id" => 0,
                        "type" => 1,
                        "name" => "Mr. Ryo",
                        "stats" => [
                            "is_alive" => true,
                            "armor" => 130,
                            "armor_cap" => 280,
                            "hitpoints" => 420,
                            "hitpoints_cap" => 420,
                            "energy" => 350,
                            "energy_cap" => 350,
                            "movement_range" => 1,
                            "movement_range_cap" => 1,
                            "is_stunned" => false,
                            "status_effects" => [
                            ]
                        ],
                        "position" => [
                            "x" => 8,
                            "y" => 3
                        ]
                    ],
                    [
                        "id" => 1,
                        "type" => 2,
                        "name" => "Kix",
                        "stats" => [
                            "is_alive" => true,
                            "armor" => 0,
                            "armor_cap" => 0,
                            "hitpoints" => 350,
                            "hitpoints_cap" => 350,
                            "energy" => 250,
                            "energy_cap" => 250,
                            "movement_range" => 1,
                            "movement_range_cap" => 1,
                            "is_stunned" => false,
                            "status_effects" => [
                            ]
                        ],
                        "position" => [
                            "x" => 2,
                            "y" => 1
                        ]
                    ],
                    [
                        "id" => 2,
                        "type" => 5,
                        "name" => "Buzz",
                        "stats" => [
                            "is_alive" => true,
                            "armor" => 50,
                            "armor_cap" => 50,
                            "hitpoints" => 150,
                            "hitpoints_cap" => 150,
                            "energy" => 230,
                            "energy_cap" => 250,
                            "movement_range" => 1,
                            "movement_range_cap" => 1,
                            "is_stunned" => false,
                            "status_effects" => [
                            ]
                        ],
                        "position" => [
                            "x" => 8,
                            "y" => 4
                        ]
                    ]
                ],
                "map" => [
                    [
                        [
                            "id" => 0,
                            "type" => 2,
                            "name" => "Exit Gate",
                            "position" => [
                                "x" => 0,
                                "y" => 0
                            ],
                            "config" => [
                                "is_charged" => true
                            ]
                        ],
                        [
                            "id" => 1,
                            "type" => 15,
                            "name" => "Booby Trap",
                            "position" => [
                                "x" => 0,
                                "y" => 1
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 2,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 0,
                                "y" => 2
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 3,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 0,
                                "y" => 3
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 4,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 0,
                                "y" => 4
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 5,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 0,
                                "y" => 5
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 6,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 0,
                                "y" => 6
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 7,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 0,
                                "y" => 7
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 8,
                            "type" => 3,
                            "name" => "Wall mark 0",
                            "position" => [
                                "x" => 0,
                                "y" => 8
                            ],
                            "config" => [
                            ]
                        ]
                    ],
                    [
                        [
                            "id" => 9,
                            "type" => 15,
                            "name" => "Booby Trap",
                            "position" => [
                                "x" => 1,
                                "y" => 0
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 10,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 1,
                                "y" => 1
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 11,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 1,
                                "y" => 2
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 12,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 1,
                                "y" => 3
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 13,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 1,
                                "y" => 4
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 14,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 1,
                                "y" => 5
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 15,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 1,
                                "y" => 6
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 16,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 1,
                                "y" => 7
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 17,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 1,
                                "y" => 8
                            ],
                            "config" => [
                            ]
                        ]
                    ],
                    [
                        [
                            "id" => 18,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 2,
                                "y" => 0
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 19,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 2,
                                "y" => 1
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 20,
                            "type" => 12,
                            "name" => "Death Pit",
                            "position" => [
                                "x" => 2,
                                "y" => 2
                            ],
                            "config" => [
                                "is_charged" => false
                            ]
                        ],
                        [
                            "id" => 21,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 2,
                                "y" => 3
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 22,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 2,
                                "y" => 4
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 23,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 2,
                                "y" => 5
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 24,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 2,
                                "y" => 6
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 25,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 2,
                                "y" => 7
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 26,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 2,
                                "y" => 8
                            ],
                            "config" => [
                            ]
                        ]
                    ],
                    [
                        [
                            "id" => 27,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 3,
                                "y" => 0
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 28,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 3,
                                "y" => 1
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 29,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 3,
                                "y" => 2
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 30,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 3,
                                "y" => 3
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 31,
                            "type" => 4,
                            "name" => "Energy Regenerator",
                            "position" => [
                                "x" => 3,
                                "y" => 4
                            ],
                            "config" => [
                                "is_charged" => true
                            ]
                        ],
                        [
                            "id" => 32,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 3,
                                "y" => 5
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 33,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 3,
                                "y" => 6
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 34,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 3,
                                "y" => 7
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 35,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 3,
                                "y" => 8
                            ],
                            "config" => [
                            ]
                        ]
                    ],
                    [
                        [
                            "id" => 36,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 4,
                                "y" => 0
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 37,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 4,
                                "y" => 1
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 38,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 4,
                                "y" => 2
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 39,
                            "type" => 5,
                            "name" => "Armor Regenerator",
                            "position" => [
                                "x" => 4,
                                "y" => 3
                            ],
                            "config" => [
                                "is_charged" => true
                            ]
                        ],
                        [
                            "id" => 40,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 4,
                                "y" => 4
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 41,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 4,
                                "y" => 5
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 42,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 4,
                                "y" => 6
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 43,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 4,
                                "y" => 7
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 44,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 4,
                                "y" => 8
                            ],
                            "config" => [
                            ]
                        ]
                    ],
                    [
                        [
                            "id" => 45,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 5,
                                "y" => 0
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 46,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 5,
                                "y" => 1
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 47,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 5,
                                "y" => 2
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 48,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 5,
                                "y" => 3
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 49,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 5,
                                "y" => 4
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 50,
                            "type" => 12,
                            "name" => "Death Pit",
                            "position" => [
                                "x" => 5,
                                "y" => 5
                            ],
                            "config" => [
                                "is_charged" => true
                            ]
                        ],
                        [
                            "id" => 51,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 5,
                                "y" => 6
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 52,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 5,
                                "y" => 7
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 53,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 5,
                                "y" => 8
                            ],
                            "config" => [
                            ]
                        ]
                    ],
                    [
                        [
                            "id" => 54,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 6,
                                "y" => 0
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 55,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 6,
                                "y" => 1
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 56,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 6,
                                "y" => 2
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 57,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 6,
                                "y" => 3
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 58,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 6,
                                "y" => 4
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 59,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 6,
                                "y" => 5
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 60,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 6,
                                "y" => 6
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 61,
                            "type" => 3,
                            "name" => "Wall mark 0",
                            "position" => [
                                "x" => 6,
                                "y" => 7
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 62,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 6,
                                "y" => 8
                            ],
                            "config" => [
                            ]
                        ]
                    ],
                    [
                        [
                            "id" => 63,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 7,
                                "y" => 0
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 64,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 7,
                                "y" => 1
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 65,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 7,
                                "y" => 2
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 66,
                            "type" => 1,
                            "name" => "Obstacle",
                            "position" => [
                                "x" => 7,
                                "y" => 3
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 67,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 7,
                                "y" => 4
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 68,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 7,
                                "y" => 5
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 69,
                            "type" => 3,
                            "name" => "Wall mark 0",
                            "position" => [
                                "x" => 7,
                                "y" => 6
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 70,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 7,
                                "y" => 7
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 71,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 7,
                                "y" => 8
                            ],
                            "config" => [
                            ]
                        ]
                    ],
                    [
                        [
                            "id" => 72,
                            "type" => 3,
                            "name" => "Wall mark 0",
                            "position" => [
                                "x" => 8,
                                "y" => 0
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 73,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 8,
                                "y" => 1
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 74,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 8,
                                "y" => 2
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 75,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 8,
                                "y" => 3
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 76,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 8,
                                "y" => 4
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 77,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 8,
                                "y" => 5
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 78,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 8,
                                "y" => 6
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 79,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 8,
                                "y" => 7
                            ],
                            "config" => [
                            ]
                        ],
                        [
                            "id" => 80,
                            "type" => 0,
                            "name" => "Blank",
                            "position" => [
                                "x" => 8,
                                "y" => 8
                            ],
                            "config" => [
                            ]
                        ]
                    ]
                ],
                "verdict" => [
                    "context" => "game-ended",
                    "statement" => "player-surrendered",
                    "winner" => null
                ]
            ];
    }

//    public function init(int $mode, string $opponent = null)
//    {
//        return Http::post($this->apiUrl . '/init', [
//            'ckey' => $this->ckey,
//            'mode' => $mode,
//            'opponent' => $opponent
//        ])->json();
//    }

//    public function checkState()
//    {
//        return Http::get($this->apiUrl . '/check-state', [
//            'ckey' => $this->ckey,
//        ])->json();
//    }

    public function castSkill(int $skill_id, int $x, int $y)
    {
        return Http::post($this->apiUrl . '/cast-skill', [
            'ckey' => $this->ckey,
            'skill_id' => $skill_id,
            'x' => $x,
            'y' => $y
        ])->json();
    }

    public function move(int $x, int $y)
    {
        return Http::post($this->apiUrl . '/move', [
            'ckey' => $this->ckey,
            'x' => $x,
            'y' => $y
        ])->json();
    }

    public function surrender() // This is not needed as my bots never surrender ;)
    {
        return Http::post($this->apiUrl . '/surrender', [
            'ckey' => $this->ckey,
        ])->json();
    }
}
