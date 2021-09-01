<?php

namespace App\Repositories;

use App\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    /**
     * @throws \Exception
     */
    public function __construct(string $model, string $dataSource = 'eloquent', $ttl = 86400)
    {
        switch ($dataSource){
            case 'cache':
                $this->model = new Cache();
                break;
            case 'eloquent':
                $this->model = new $model;
                break;
            case 'redis':
                $this->model = new Redis();
                break;
            case 'http':
                $this->model = new Http();
                break;
            default:
                throw new \Exception('Unexpected value');
        }
    }
}
