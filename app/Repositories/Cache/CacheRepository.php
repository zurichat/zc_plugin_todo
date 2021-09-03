<?php

namespace App\Repositories\Cache;

use App\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\Cache;

class CacheRepository implements RepositoryInterface
{
    protected $modelName;
    protected $model;

    public function __construct($modelName)
    {
        $this->modelName = $modelName;
        $this->model = new Cache();
    }

    public function all()
    {
        return $this->model::get($this->modelName);
    }

    public function find($id, $attributes = ['*'])
    {
        $records = $this->all();
        $key = array_search($id, array_column($records, 'id'));
        return $records[$key];
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
        // TODO: Implement findBy() method.
    }

    public function findFirst($attributes = ['*'])
    {
        // TODO: Implement findFirst() method.
    }

    public function findAll($attributes = ['*'])
    {
        // TODO: Implement findAll() method.
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
        $records = $this->all() ? $this->all() : [];
        $attributes = array_merge($attributes, ['id' => count($records) + 1]);
        array_push($records, $attributes);
        return $this->model::put($this->modelName, $records);
    }

    public function update($id, array $attributes = [], bool $syncRelations = false)
    {
        $records = $this->all();
        $key = array_search($id, array_column($records, 'id'));
        $id = $records[$key]['id'];
        unset($records[$key]);
        $attributes = array_merge($attributes, ['id' => $id]);
        array_push($records, $attributes);
        return $this->model::put($this->modelName, array_values($records));
    }

    public function store($id, array $attributes = [], bool $syncRelations = false)
    {
        $records = $this->all() ? $this->all() : [];
        $attributes = array_merge($attributes, ['id' => count($records) + 1]);
        array_push($records, $attributes);
        return $this->model::put($this->modelName, $records);
    }

    public function delete($id)
    {
        $records = $this->all();
        $key = array_search($id, array_column($records, 'id'));
        unset($records[$key]);
        return $this->model::put($this->modelName, array_values($records));
    }

    public function restore($id)
    {
        // TODO: Implement restore() method.
    }

    /**
     * Search for specific value
     * @param mixed $value
     * @return mixed
     */
    public function search($field, $value)
    {
       $todos = $this->all();
       $search_arr = [];
       for($i = 0; $i < count($todos); $i++){
            if(collect($todos)->where($field, $value)){
                array_push($arr, $todos[$i]);
            }
        return $search_arr;
        }
    }
}
