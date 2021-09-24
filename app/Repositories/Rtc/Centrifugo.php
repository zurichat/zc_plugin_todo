<?php

namespace App\Repositories\Rtc;

use App\Contracts\CentrifugoInterface;
use Illuminate\Support\Facades\Http;

class Centrifugo implements CentrifugoInterface
{

    protected $url = "https://realtime.zuri.chat/api";

    public function publish($channel, $data, $newChannel, $subscriberId = null, $collection =null, $unSubsciberId = null)
    {
        $response = Http::withHeaders([

            'Content-type' => 'application/json',
            'Authorization' => 'apikey 58c2400b-831d-411d-8fe8-31b6e337738b'//58c2400b-831d-411d-8fe8-31b6e337738b'

        ])->post($this->url, [
            'method' => 'publish',
            'params' => [
                "channel" => $channel,
                "data" => [
                    "subscriberId" => $subscriberId,
                    "collection" => $collection,
                    "channel" => $newChannel,
                    "details"  => $data,
                    "unSubscriberId" => $unSubsciberId
                ],
                
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
        ])->get($this->url, [
            "method" => "unsubscribe",
            "params" => [
                "channel" => $channel,
                "user" => $id
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
                'channels' => $channel,
                'data' => $data
            ]
        ]);

        return response()->json([
            "data" => $response->json()
        ], 200);
    }
}
