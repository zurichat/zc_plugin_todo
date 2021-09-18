<?php

namespace App\Repositories\HTTP;

use App\Contracts\RepositoryInterface;
use App\Helpers\HelperFnc;
use Illuminate\Support\Facades\Http;

class HTTPRepository implements RepositoryInterface
{
<<<<<<< HEAD
    protected $url = 'https://api.zuri.chat/';


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
        $data = $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id . '?' . $whereStr)->json();
        return array_filter($data, function ($v) {
            return !isset($v['deleted_at']);
        });
=======
    protected $url = 'https://zccore.herokuapp.com/';
    protected $organisation_id = '612a3a914acf115e685df8e3';
    protected $modelName;

    {
        $this->model = new Http();
    }

    {
<<<<<<< HEAD
=======
        // return Http::get($this->url)->json();
>>>>>>> d06069ebbd65ecc96c6657afbcf312221185aa8f
    }
    public function find($id, $attributes = ['*'])
    {
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->org . '?_id=' . $id)->json();
=======
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id .'/'. $this->modelName . '/' . $this->organisation_id)->json();
>>>>>>> d06069ebbd65ecc96c6657afbcf312221185aa8f
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
<<<<<<< HEAD
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->org . '?' . $attribute . '=' . $value)->json();
=======
        // TODO: Implement findBy() method.
>>>>>>> d06069ebbd65ecc96c6657afbcf312221185aa8f
    }

    public function findFirst($attributes = ['*'])
    {
<<<<<<< HEAD
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id)->json()['data'][0];
=======
        // TODO: Implement findFirst() method.
>>>>>>> d06069ebbd65ecc96c6657afbcf312221185aa8f
    }

    public function findAll($attributes = ['*'])
    {
<<<<<<< HEAD
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id)->json();
=======
        // TODO: Implement findAll() method.
>>>>>>> d06069ebbd65ecc96c6657afbcf312221185aa8f
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
<<<<<<< HEAD
        $whereStr = HelperFnc::queryBuilder($where);
        return $this->model::get($this->url . 'data/read/' . $this->plugin_id . '/' . $this->modelName . '/' . $this->organisation_id . '?' . $whereStr)->json();
=======
        // TODO: Implement findWhere() method.
>>>>>>> d06069ebbd65ecc96c6657afbcf312221185aa8f
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
<<<<<<< HEAD
        return $this->model::put($this->url . 'data/write', [
=======
        return $this->model::post($this->url . 'data/write', [
>>>>>>> d06069ebbd65ecc96c6657afbcf312221185aa8f
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
<<<<<<< HEAD
        return $this->model::delete($this->url . 'data/write', [
=======
        return $this->model::post($this->url . 'data/write', [
>>>>>>> d06069ebbd65ecc96c6657afbcf312221185aa8f
            "plugin_id" => $this->plugin_id,
            "organization_id" => $this->organisation_id,
            "collection_name" => $this->modelName,
            "bulk_write" => false,
            "object_id" => $id,
            "filter" => (object) [],
<<<<<<< HEAD
            "payload" => (object) []
        ])->json()['data'];
=======
            "payload" =>(object) []
        ])->json();
>>>>>>> d06069ebbd65ecc96c6657afbcf312221185aa8f
    }

    public function restore($id)
    {
        // TODO: Implement restore() method.
    }

<<<<<<< HEAD
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
    public function findUser($data, $cookie)
    {
        $user = $this->model::withHeaders(['Cookie' => $cookie])->get($this->url . '/users/' . $data['user_id'])
                ->json();
        if (isset($user['status']) && $user['status'] == '200') {
           return $user['data'];
        }else{
            return $user;
        }
=======
    public function search($key, $data)
    {
        $todos = $this->all();
        $search_data = [];
        for($i = 0; $i < count($todos['data']); $i++){
            if(array_key_exists($key, $todos['data'][$i])){
                if($todos['data'][$i][$key] == $data){
                    array_push($search_data, $todos['data'][$i]);
                }
            }

        }
        return $search_data;
>>>>>>> d06069ebbd65ecc96c6657afbcf312221185aa8f
    }
}
