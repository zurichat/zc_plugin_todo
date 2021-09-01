<?php

namespace App\Contracts;

interface RepositoryInterface
{
    public function all();
    /**
     * Find an entity by its primary key.
     *
     * @param int   $id
     * @param array $attributes
     *
     * @return mixed
     */
    public function find($id, $attributes = ['*']);

    /**
     * Find an entity by its primary key or throw an exception.
     *
     * @param mixed $id
     * @param array $attributes
     *
     * @throws \RuntimeException
     *
     * @return mixed
     */
    public function findOrFail($id, $attributes = ['*']);

    /**
     * Find an entity by its primary key or return fresh entity instance.
     *
     * @param mixed $id
     * @param array $attributes
     *
     * @return mixed
     */
    public function findOrNew($id, $attributes = ['*']);

    /**
     * Find an entity by one of its attributes.
     *
     * @param string $attribute
     * @param string $value
     * @param array  $attributes
     *
     * @return mixed
     */
    public function findBy($attribute, $value, $attributes = ['*']);

    /**
     * Find the first entity.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function findFirst($attributes = ['*']);

    /**
     * Find all entities.
     *
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findAll($attributes = ['*']);

    /**
     * Paginate all entities.
     *
     * @param int|null $perPage
     * @param array    $attributes
     * @param string   $pageName
     * @param int|null $page
     *
     * @throws \InvalidArgumentException
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($perPage = null, $attributes = ['*'], $pageName = 'page', $page = null);

    /**
     * Paginate all entities into a simple paginator.
     *
     * @param int|null $perPage
     * @param array    $attributes
     * @param string   $pageName
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function simplePaginate($perPage = null, $attributes = ['*'], $pageName = 'page');

    /**
     * Find all entities matching where conditions.
     *
     * @param array $where
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findWhere(array $where, $attributes = ['*']);

    /**
     * Find all entities matching whereIn conditions.
     *
     * @param array $where
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findWhereIn(array $where, $attributes = ['*']);

    /**
     * Find all entities matching whereNotIn conditions.
     *
     * @param array $where
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findWhereNotIn(array $where, $attributes = ['*']);

    /**
     * Find all entities matching whereHas conditions.
     *
     * @param array $where
     * @param array $attributes
     *
     * @return \Illuminate\Support\Collection
     */
    public function findWhereHas(array $where, $attributes = ['*']);

    /**
     * Create a new entity with the given attributes.
     *
     * @param array $attributes
     * @param bool  $syncRelations
     *
     * @return mixed
     */
    public function create(array $attributes = [], bool $syncRelations = false);

    /**
     * Update an entity with the given attributes.
     *
     * @param mixed $id
     * @param array $attributes
     * @param bool  $syncRelations
     *
     * @return mixed
     */
    public function update($id, array $attributes = [], bool $syncRelations = false);

    /**
     * Store the entity with the given attributes.
     *
     * @param mixed $id
     * @param array $attributes
     * @param bool  $syncRelations
     *
     * @return mixed
     */
    public function store($id, array $attributes = [], bool $syncRelations = false);

    /**
     * Delete an entity with the given id.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id);

    /**
     * Restore an entity with the given id.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function restore($id);
}
