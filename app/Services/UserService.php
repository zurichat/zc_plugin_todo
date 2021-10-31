<?php

namespace App\Services;

use App\Helpers\Response;
use App\Repositories\TodoRepository;
use Illuminate\Support\Facades\Config;

class UserService extends TodoRepository
{
    /**
     * Check if task belongs to user
     */
    public static function belongToUser($item)
    {
        // check if key exist
        if(isset($item['user_id'])){
            // if key exist, check if key is null
            // if null, todo is invalid
            // else todo belongs to user
            return $item['user_id'] == Config::get('user_id') ? true : false;
        }
        // if key does not exist
        // todo is not invalid
        return false;
    }

    /**
     * Check if user is a collaborator
     */
    public function isACollaborator($item)
    {
        if(isset($item['collaborators'])){
            $items = collect($item['collaborators'])->flatten()->toArray();
            return in_array(Config::get('user_id'), $items);
        }
        return false;
    }

    public function findUser($data, $bearerToken){
        return $this->httpRepository->findUser($data,$bearerToken);
    }
}
