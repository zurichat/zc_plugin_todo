<?php

namespace App\Services;

use App\Helpers\Response;

trait ServiceTrait
{

    /**
     * fetch from server if cache is empty
     * @return mixed
     */
    public function fetchDataFromServer()
    {
        $response = $this->httpRepository->all();
        //update cache if response is successful
        if (($response['status'] == 200 || $response['status'] == "success") && isset($response["data"]) && $response["data"] != null) {
            $this->cacheRepository->create($response['data']);

            return;
        }

    }
    
}
