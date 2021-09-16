<?php

namespace App\Repositories\Rtc;

use App\Contracts\CentrifugoInterface;
use Illuminate\Support\Facades\Http;

class Centrifugo implements CentrifugoInterface
{
    protected $http;
    protected $url = "http://localhost:8000/api";
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = "aec93168-52fe-4da9-8568-23f22b7e08cc";//env('centrifugo.CENTRIFUGO_APIKEY');
    }


    public function publish($channel, $data)
    {
        $response = Http::withHeaders([
            'Content-type' => 'application/json',
            'Authorization' => 'apikey aec93168-52fe-4da9-8568-23f22b7e08cc'
        ])->post($this->url, [
            'method' => 'publish',
            'params' => [
                'channel' => $channel,
                'data' => $data
            ]
        ]);

        return response()->json([
            "data" => $response->json()
        ], 200);
    }

    public function unSubscribe($channel, $id)
    {
        $response = Http::withHeaders([
            'Content-type' => 'application/json',
            'Authorization' => 'apikey aec93168-52fe-4da9-8568-23f22b7e08cc'
        ])->post($this->url, [
            'method' => 'unsubscribe',
            'params' => [
                'channel' => $channel,
                'user' => $id
            ]
        ]);

        return response()->json([
            "data" => $response->json()
        ], 200);
    }

    public function broadcast(array $channel, array $data)
    {
        $response = Http::withHeaders([
            'Content-type' => 'application/json',
            'Authorization' => 'apikey aec93168-52fe-4da9-8568-23f22b7e08cc'
        ])->post($this->url, [
            'method' => 'broadcast',
            'params' => [
                'channel' => $channel,
                'data' => $data
            ]
        ]);

        return response()->json([
            "data" => $response->json()
        ], 200);
    }

}