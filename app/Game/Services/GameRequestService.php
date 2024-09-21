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

    public function init(int $mode, string $opponent = null)
    {
        return Http::post($this->apiUrl . '/init', [
            'ckey' => $this->ckey,
            'mode' => $mode,
            'opponent' => $opponent
        ])->json();
    }

    public function checkState()
    {
        return Http::get($this->apiUrl . '/check-state', [
            'ckey' => $this->ckey,
        ])->json();
    }

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
