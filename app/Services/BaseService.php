<?php

namespace App\Services;

use GuzzleHttp\Client;
use DiDom\Document;
use Illuminate\Support\Facades\Redis;

class BaseService
{
    public function getHttpClient(): Client
    {
        return new Client([
            'base_uri' => env('LEAGUE_BASE_URL'),
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function getLeaguesData(): array
    {
        $response = $this->getHttpClient()->get('/GetLeagueInfoList/v001');

        $data = $response->getBody()->getContents();

        return $this->getInfoFromHtml($data);
    }

    private function getInfoFromHtml(string $html)
    {
        $document = new Document($html);

        $document->find('pre');

        //something gone wrong with parsing html

        return [
            [
                "league_id" => 17,
                "name" =>"G-1 Champions League Season 5",
                "start_timestamp" => 1363651200,
                "end_timestamp" => 1366329600
            ]
        ];
    }

    public function getActualLeagues()
    {
        $redis = Redis::connection();

        $data = $redis->get('league_actual');

        if (empty($data)) {
            $data = json_encode($this->getLeaguesData());
            $redis->set('league_actual', $data);
        }

        return json_decode($data, true);
    }

}
