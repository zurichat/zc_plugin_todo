<?php

namespace App\Repositories\HTTP;

use App\Repositories\BaseRepository;

class TaskHTTPRepository extends BaseRepository
{
    protected $modelName = 'Task';

    protected $url = 'https://jsonplaceholder.typicode.com/';

    public function __construct()
    {
        parent::__construct($this->modelName, 'http');
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model::get($this->url . 'todos')->json();
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
        return $this->model::get($this->url . 'todos/' . $id)->json();
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
        return $this->model::put($this->modelName, $attributes);
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
        // TODO: Implement update() method.
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
        // TODO: Implement delete() method.
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
}
