<?php

namespace App\Traits;

trait HTTPRepoResponseHandler{

    public function respondWithData($data)
    {
        if($data['status'] == 200 && isset($data["data"])){
            return $data["data"];
        }
    }

    public function respondWithoutData(array $data)
    {
        # code...
    }
}