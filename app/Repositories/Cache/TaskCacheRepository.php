<?php

namespace App\Repositories\Cache;

use App\Contracts\RepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;

class TaskCacheRepository extends BaseRepository
{
    protected $modelName = 'Task';

    public function __construct()
    {
        parent::__construct($this->modelName, 'cache');
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model::get($this->modelName);
    }

    /**
     * Find an entity by its primary key.
     *
     * @param int $id
     * @param array $attributes
     *
     * @return mixed
     */
    public function find($id, $attributes = ['*'])
    {
        $records = $this->all();
        $key = array_search($id, array_column($records, 'id'));
        return $records[$key];
    }

    /**
     * Find an entity by its primary key or throw an exception.
     *
     * @param mixed $id
     * @param array $attributes
     *
     * @return mixed
     * @throws \RuntimeException
     *
     */
    public function findOrFail($id, $attributes = ['*'])
    {
        // TODO: Implement findOrFail() method.
    }

    /**
     * Find an entity by its primary key or return fresh entity instance.
     *
     * @param mixed $id
     * @param array $attributes
     *
     * @return mixed
     */
    public function findOrNew($id, $attributes = ['*'])
    {
        // TODO: Implement findOrNew() method.
    }

    /**
     * Find an entity by one of its attributes.
     *
     * @param string $attribute
     * @param string $value
     * @param array $attributes
     *
     * @return mixed
     */
    public function findBy($attribute, $value, $attributes = ['*'])
    {
        // TODO: Implement findBy() method.
    }

    /**
     * Find the first entity.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function findFirst($attributes = ['*'])
    {
        // TODO: Implement findFirst() method.
    }

    /**
     * Find all entities.
     *
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findAll($attributes = ['*'])
    {
        // TODO: Implement findAll() method.
    }

    /**
     * Paginate all entities.
     *
     * @param int|null $perPage
     * @param array $attributes
     * @param string $pageName
     * @param int|null $page
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @throws \InvalidArgumentException
     *
     */
    public function paginate($perPage = null, $attributes = ['*'], $pageName = 'page', $page = null)
    {
        // TODO: Implement paginate() method.
    }

    /**
     * Paginate all entities into a simple paginator.
     *
     * @param int|null $perPage
     * @param array $attributes
     * @param string $pageName
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function simplePaginate($perPage = null, $attributes = ['*'], $pageName = 'page')
    {
        // TODO: Implement simplePaginate() method.
    }

    /**
     * Find all entities matching where conditions.
     *
     * @param array $where
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findWhere(array $where, $attributes = ['*'])
    {
        // TODO: Implement findWhere() method.
    }

    /**
     * Find all entities matching whereIn conditions.
     *
     * @param array $where
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findWhereIn(array $where, $attributes = ['*'])
    {
        // TODO: Implement findWhereIn() method.
    }

    /**
     * Find all entities matching whereNotIn conditions.
     *
     * @param array $where
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findWhereNotIn(array $where, $attributes = ['*'])
    {
        // TODO: Implement findWhereNotIn() method.
    }

    /**
     * Find all entities matching whereHas conditions.
     *
     * @param array $where
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findWhereHas(array $where, $attributes = ['*'])
    {
        // TODO: Implement findWhereHas() method.
    }

    /**
     * Create a new entity with the given attributes.
     *
     * @param array $attributes
     * @param bool $syncRelations
     *
     * @return mixed
     */
    public function create(array $attributes = [], bool $syncRelations = false)
    {
        $records = $this->all() ? $this->all() : [];
        $attributes = array_merge($attributes, ['id' => count($records) + 1]);
        array_push($records, $attributes);
        return $this->model::put($this->modelName, $records);
    }

    /**
     * Update an entity with the given attributes.
     *
     * @param mixed $id
     * @param array $attributes
     * @param bool $syncRelations
     *
     * @return mixed
     */
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

    /**
     * Store the entity with the given attributes.
     *
     * @param mixed $id
     * @param array $attributes
     * @param bool $syncRelations
     *
     * @return mixed
     */
    public function store($id, array $attributes = [], bool $syncRelations = false)
    {
        // TODO: Implement store() method.
    }

    /**
     * Delete an entity with the given id.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $records = $this->all();
        $key = array_search($id, array_column($records, 'id'));
        unset($records[$key]);
        return $this->model::put($this->modelName, array_values($records));
    }

    /**
     * Restore an entity with the given id.
     *
     * @param mixed $id
     *
     * @return mixed
     */
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
