<?php

namespace App\Contracts;

interface CentrifugoInterface
{
    /**
     * pass data to be send as message
     * @param $data
     * @return
     */

    public function publishToCommonRoom(array $data, string $newChannel, string $subscriberId, string $collection, string $unSubsciberId);

    /**
     * pass data to be send as message
     * @param $data
     * @return
     */

    public function publishToRoomChannel(string $channel, array $data, string $collection, string $action);

    /**   
     * pass user id 
     * @param $data
     * @return
     */

    public function unSubscribe(string $channel, $id);

    /**
     * send same message to many channels
     * @param $data
     * @return
     */

    public function broadcast(array $channel, array $data);
}
