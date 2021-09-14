<?php

namespace App\Repositories\HTTP;

use App\Contracts\RepositoryInterface;
use App\Helpers\HelperFnc;
use Illuminate\Support\Facades\Http;

class HTTPRepository implements RepositoryInterface
{
    protected $url = 'https://api.zuri.chat/';

    protected $modelName;
    protected $model;
    protected $org = '613a3ac959842c7444fb0240';
    protected $plugin_id = '6138deac99bd9e223a37d8f5';
    protected $organisation_id = '613a3ac959842c7444fb0240'; // same as $org but let's keep for now

    public function __construct($modelName = "")
    {
        $this->modelName = $modelName;
        $this->model = new Http();
        // Had to commentout the credentials for session cause they were'nt working   
        // $this->organisation_id = session('organisation_id'); 
        // $this->plugin_id = session('plugin_id');

    }

    public function allWithoutDeletedWhere(array $where)
    {
        $whereStr = HelperFnc::queryBuilder($where);
        $data = $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id . '?' . $whereStr)->json()['data'];
        return array_filter($data, function ($v) {
            return !isset($v['deleted_at']);
        });
    }

    public function all()
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->org)->json()['data'];
    }

    public function find($id, $attributes = ['*'])
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->org . '?_id=' . $id)->json()['data'];
    }

    public function findOrFail($id, $attributes = ['*'])
    {
        // TODO: Implement findOrFail() method.
    }

    public function findOrNew($id, $attributes = ['*'])
    {
        // TODO: Implement findOrNew() method.
    }

    public function findBy($attribute, $value, $attributes = ['*'])
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->org . '?' . $attribute . '=' . $value)->json()['data'];
    }

    public function findFirst($attributes = ['*'])
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id)->json()['data'][0];
    }

    public function findAll($attributes = ['*'])
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id)->json()['data'];
    }

    public function paginate($perPage = null, $attributes = ['*'], $pageName = 'page', $page = null)
    {
        // TODO: Implement paginate() method.
    }

    public function simplePaginate($perPage = null, $attributes = ['*'], $pageName = 'page')
    {
        // TODO: Implement simplePaginate() method.
    }

    public function findWhere(array $where, $attributes = ['*'])
    {
        $whereStr = HelperFnc::queryBuilder($where);
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id . '?' . $whereStr)->json();
    }

    public function findWhereIn(array $where, $attributes = ['*'])
    {
        // TODO: Implement findWhereIn() method.
    }

    public function findWhereNotIn(array $where, $attributes = ['*'])
    {
        // TODO: Implement findWhereNotIn() method.
    }

    public function findWhereHas(array $where, $attributes = ['*'])
    {
        // TODO: Implement findWhereHas() method.
    }

    public function create(array $attributes = [], bool $syncRelations = false)
    {
        return $this->model::post($this->url . 'data/write', [
            "plugin_id" => $this->plugin_id,
            "organization_id" => $this->organisation_id,
            "collection_name" => $this->modelName,
            "bulk_write" => false,
            "object_id" => "xxxx",
            "filter" => (object) [],
            "payload" => $attributes
        ])->json();
    }

    public function update($id, array $attributes = [], bool $syncRelations = false)
    {
        return $this->model::put($this->url . 'data/write', [
            "plugin_id" => $this->plugin_id,
            "organization_id" => $this->organisation_id,
            "collection_name" => $this->modelName,
            "bulk_write" => false,
            "object_id" => $id,
            "filter" => (object) [],
            "payload" => $attributes
        ])->json();
    }

    public function store($id, array $attributes = [], bool $syncRelations = false)
    {
        return $this->model::post($this->url . 'data/write', [
            "plugin_id" => $this->plugin_id,
            "organization_id" => $this->organisation_id,
            "collection_name" => $this->modelName,
            "bulk_write" => false,
            "object_id" => "xxxx",
            "filter" => (object) [],
            "payload" => $attributes
        ])->json();
    }

    public function delete($id)
    {
        return $this->model::delete($this->url . 'data/write', [
            "plugin_id" => $this->plugin_id,
            "organization_id" => $this->organisation_id,
            "collection_name" => $this->modelName,
            "bulk_write" => false,
            "object_id" => $id,
            "filter" => (object) [],
            "payload" => (object) []
        ])->json()['data'];
    }

    public function restore($id)
    {
        // TODO: Implement restore() method.
    }

    /**
     * This will search for a models with a specif key-value pair
     */
    public function search($key, $data)
    {
        $objects = $this->all();
        if (isset($objects['status']) && $objects['status'] == '404') {
            return ["status" => "error"];
        }
        $search_data = [];
        for ($i = 0; $i < count($objects); $i++) {
            if ($objects[$i][$key] == $data) {
                array_push($search_data, $objects[$i]);
            }
        }
        return $search_data;
    }


    /**
     * This will archive a model
     */
    public function archive($id)
    {
        $this->update($id, ['archived_at' => now()]);
    }

    /**
     * This will unarchive a model
     */
    public function unarchive($id)
    {
        $this->update($id, ['archived_at' => null]);
    }

    /**
     * Get users details by the userID
     */
    public function findUser($data)
    {
        return $this->model::get($this->url . '/users/' . $data['user_id'] . '?session=' . $data['session_id'])
            ->json();
    }
}
