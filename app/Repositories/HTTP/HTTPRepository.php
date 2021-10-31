<?php

namespace App\Repositories\HTTP;

use App\Constants\AppConstants;
use App\Contracts\RepositoryInterface;
use App\Helpers\HelperFnc;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class HTTPRepository implements RepositoryInterface
{
    protected $url = 'https://api.zuri.chat/';

    protected $modelName;
    protected $model;
    // protected $plugin_id = '6138deac99bd9e223a37d8f5';
    protected $plugin_id = AppConstants::PLUGIN_ID;
    protected $organisation_id; // = '613a3ac959842c7444fb0240'; // same as $org but let's keep for now

    public function __construct($modelName = "")
    {
        $this->modelName = $modelName;
        $this->model = new Http();
        $this->organisation_id = Config::get('organisation_id');
    }

    public function allWithoutDeletedWhere(array $where)
    {
        $whereStr = HelperFnc::queryBuilder($where);
        $data = $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id . '?' . $whereStr)->json();
        return array_filter($data, function ($v) {
            return !isset($v['deleted_at']);
        });
    }

    public function all()
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id)->json();
    }

    public function find($id, $attributes = ['*'])
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id . '?_id=' . $id)->json();
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
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id . '?' . $attribute . '=' . $value)->json();
    }

    public function findFirst($attributes = ['*'])
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id)->json()['data'][0];
    }

    public function findAll($attributes = ['*'])
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id)->json();
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
     * This will will fetch users in a workspace
     */

    public function findWorkSpaceUsers($bearerToken)
    {
        $urlConstruct = $this->url . 'organizations/' . $this->organisation_id . '/members';
        $authorization = ['Authorization' => 'Bearer ' . $bearerToken];
        return Http::withHeaders($authorization)->get($urlConstruct)->json();
        // return $this->model::withHeaders($authorization)->get($urlConstruct)->json();
    }

    /**
     * Get users details by the userID
     */
    public function findUser($data, $bearerToken)
    {
        $user = $this->model::withHeaders(['Authorization' => $bearerToken])->get($this->url . '/users/' . $data['user_id'])
            ->json();
        if (isset($user['status']) && $user['status'] == '200') {
            return $user['data'];
        } else {
            return $user;
        }
    }

    /**
     * Read with Post Request
     */

    public function findWhereWithPost(array $filter = [])
    {
        return $this->model::post($this->url . 'data/read', [
            "plugin_id" => $this->plugin_id,
            "organization_id" => $this->organisation_id,
            "collection_name" => $this->modelName,
            "filter" => (object) $filter
        ])->json();
    }
}
