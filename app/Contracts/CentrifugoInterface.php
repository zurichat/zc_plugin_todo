<?php

namespace App\Contracts;

interface CentrifugoInterface
{
    /**
     * pass data to be send as message
     * @param $data
     * @return
     */

    public function publish(string $channel, array $data);

    /**
     * pass user id 
     * @param $data
     * @return
     */

    public function unSubscribe(string $channel, array $id);

    /**
     * send same message to many channels
     * @param $data
     * @return
     */
    
    public function broadcast(array $channel, array $data);


}
