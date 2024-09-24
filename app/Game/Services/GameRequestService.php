<?php

namespace App\Game\Services;

use App\Game\Logging\LoggerInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;

class GameRequestService
{
    private string $ckey;
    private string $apiUrl;
    private LoggerInterface $log;

    public function __construct(LoggerInterface $log)
    {
        $this->ckey = Config::get('services.game.ckey');
        $this->apiUrl = rtrim(Config::get('services.game.api_url'), '/');
        $this->log = $log;
    }

    private function sendRequest(string $method, array $params = []): ?array
    {
        try {
            $url = $this->apiUrl . '/?' . http_build_query($params);
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->{$method}($url)
                ->throw();
            return $response->json();
        } catch (RequestException $e) {
            $responseBody = $e->response ? $e->response->body() : 'No response body';
            $this->log->error("An error occurred during $method request: " . $e->getMessage() . ". Response: " . $responseBody);
            return null;
        }
    }

    public function init(int $mode, ?string $opponent = null): ?array
    {
        $this->log->info('Initializing game: ' . json_encode(['mode' => $mode, 'opponent' => $opponent]));

        $params = [
            'ckey' => $this->ckey,
            'mode' => $mode,
        ];

        if ($opponent !== null) {
            $params['opponent'] = $opponent;
        }

        return $this->sendRequest('post', $params);
    }

    public function checkState(): ?array
    {
        $this->log->info('Checking game state');

        return $this->sendRequest('get', [
            'ckey' => $this->ckey,
        ]);
    }

    public function castSkill(int $skill_id, int $x, int $y): ?array
    {
        $this->log->info('Casting skill: ' . json_encode(['skill_id' => $skill_id, 'x' => $x, 'y' => $y]));

        return $this->sendRequest('patch', [
            'ckey'     => $this->ckey,
            'skill_id' => $skill_id,
            'x'        => $x,
            'y'        => $y,
        ]);
    }

    public function move(int $x, int $y): ?array
    {
        $this->log->info('Moving to position: ' . json_encode(['x' => $x, 'y' => $y]));

        return $this->sendRequest('put', [
            'ckey' => $this->ckey,
            'x'    => $x,
            'y'    => $y,
        ]);
    }

    public function surrender(): ?array // This is not needed as my bots never surrender ;)
    {
        $this->log->info('Surrendering...');

        return $this->sendRequest('delete', [
            'ckey' => $this->ckey,
        ]);
    }
}
