<?php

namespace App\Repositories\HTTP;

use App\Contracts\RepositoryInterface;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Http;

class HTTPRepository implements RepositoryInterface
{
    protected $url = 'https://zccore.herokuapp.com/';
    protected $organisation_id = '612a3a914acf115e685df8e3';
    protected $plugin_id = '6134a7a42d91654fa0487274';

    protected $modelName;
    protected $model;

    public function __construct($modelName)
    {
        $this->modelName = $modelName;
        $this->model = new Http();
    }

    public function all()
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id)->json()['data'];
    }

    public function find($id, $attributes = ['*'])
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id . '?_id=' . $id)->json()['data'][0];
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
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id . '?' . $attribute . '=' . $value)->json()['data'][0];
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
        // TODO: Implement findWhere() method.
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
        ])->json()['data'];
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
        ])->json()['data'];
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
}
