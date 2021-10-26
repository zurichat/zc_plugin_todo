<?php

namespace App\Services;

use App\Constants\AppConstants;
use Carbon\Carbon;
use App\Helpers\Response;
use Illuminate\Support\Str;
use App\Helpers\Collaborator;
use App\Services\ServiceTrait;
use App\Repositories\TodoRepository;
use App\Providers\AppServiceProvider;
use Illuminate\Http\Client\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TodoService extends TodoRepository
{
    //use ServiceTrait;
    public function all()
    {

        return Response::checkAndServe($this->httpRepository->all());
    }


    public function create(array $data)
    {

        return Response::checkAndServe($this->httpRepository->create($data));
    }

    public function find($id)
    {
        return Response::checkAndServe($this->httpRepository->find($id));
    }

    public function findTodo($id, $user_id)
    {
        $todo =  Response::checkAndServe($this->httpRepository->findWhere(['_id' => $id, 'user_id' => $user_id]));
        if (isset($todo['data']) && $todo['data'] == null) {
            abort(404, "Todo not found");
        }
        return $todo;
    }


    public function findBy($attr, $value)
    {
        return Response::checkAndServe($this->httpRepository->findBy($attr, $value));
    }

    public function findWhere($whereArray)
    {
        return Response::checkAndServe($this->httpRepository->findWhere($whereArray));
    }


    public function updateTodo($data, $todoId, $user_id)
    {
        $todo = $this->findWhere(['_id' => $todoId]);

        //Throw an exception if todo is not found
        abort_if(isset($todo['data']) && $todo['data'] == null, 404, "Todo not found or empty");

        if ($todo['user_id'] != $user_id) {
            abort("You dont have authorization to delete", 401);
        }
        abort_if(empty($data), 400, "Request payload is empty");
        $update = $this->update($data, $todoId);

        if (isset($update['modified_documents']) && $update['modified_documents'] > 0) {
            $response = ['message' => 'Todo updated successfully', 'data' => $update];
        } else {
            abort(500, 'an error was encountered');
        }
        return $response;
    }

    public function update($data, $todoId)
    {
        return Response::checkAndServe($this->httpRepository->update($todoId, $data));
    }

    public function delete($todoId, $user_id)
    {
        $todo = $this->findWhere(['_id' => $todoId]);
        //check if the Todo is found
        //if not Throw exception
        if (isset($todo['data']) && $todo['data'] == null) {
            abort(404, "Todo not found");
        }
        //if the user that is trying to delete is not the user that created, no one else can delete
        abort_if($todo['user_id'] != $user_id, 401, "You dont have authorization to delete");

        $deleted_at = ['deleted_at' => Carbon::now()];
        $update = $this->update($deleted_at, $todoId);


        // $this->publishToRoomChannel($todo['channel'], $todo, "Todo", "delete");
        $response = (isset($update['modified_documents']) && $update['modified_documents'] > 0) ? ['message' => 'Todo deleted successfully', 'data' => $todo] : ['error' => 'an error was encountered'];
        $this->publishToRoomChannel($todo['channel'], $todo, "Todo", "delete");

        if (isset($update['modified_documents']) && $update['modified_documents'] > 0) {
            $this->publishToRoomChannel($todo['channel'], $todo, "Todo", "delete");
            // Send a mail to all the collaborators that the todo has been deleted
            $collaboratorInstance = new Collaborator(new UserService());
            $user_ids = $collaboratorInstance->listAllUsersInTodo($todo);
            $collaboratorInstance->sendMails($user_ids, 'Todo Deleted', 'A todo with the title' . $todo['title'] . 'has been deleted');
            $response = ['message' => 'Todo deleted successfully'];
        } else {
            $response = ['error' => 'an error was encountered'];
        }

        return $response;
    }

    /**
     * This will search with a specif key-value pair
     */
    public function search($data, $user_id)
    {
        $objects = $this->httpRepository->findWhere(['user_id' => $user_id]);
        //if theres an error or status of 404 throw exception
        abort_if(isset($objects['status']) && $objects['status'] == '404', 404, 'No search result found');
        //filter the todo collection and get the one that meets the searched criteria
        $search_data = collect($objects['data'])->filter(function ($todo) use ($data) {
            return Str::contains(strtolower($todo['title']), strtolower($data));
        })->values();

        return $search_data;
    }

    /**
     * Paginate the search results
     */
    public static function paginate($search, $request)
    {
        //Get the current page
        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $results_collection = collect($search);
        $perPage = 20;
        $total_count = count($results_collection);
        $page_count = ceil($total_count / $perPage);
        $first_page = 1;
        $last_page = $page_count;

        //Set the link for the next and previous pages
        $prefx = route('search', [$request->org_id, $request->user]) . '?q=' . $request->query('q') . '&member_id=' . $request->user . '&org_id=' . $request->org_id . '&page=';
        //Slice the current items in the collection to fit the required per page
        $current_page_todos = $results_collection->slice(($current_page - 1) * $perPage, $perPage)->all();
        //set the current and next pages
        $previous_page = $current_page <= 1 ? null : $prefx . ($current_page - 1);
        $next_page = $prefx . ($current_page + 1);
        $data = [
            'total_count' => $total_count,
            'current_page' => $current_page,
            'per_page' => $perPage,
            'page_count' => $page_count,
            'first_page' => $first_page,
            'last_page' => $last_page,
            'next_page' => $next_page,
            'previous_page' => $previous_page,
            'query' => $request->query('q'),
            'data' => $current_page_todos,
        ];
        return $data;
    }
    /**
     * Check if todo is archived
     */
    public static function isTodoArchived($item)
    {
        // check if key exist
        if (isset($item['archived_at'])) {
            // if key exist, check if key is null
            // if null, todo is not archived
            // else todo is archived
            return $item['archived_at'] == null ? false : true;
        }
        // if key does not exist
        // todo is not archived
        return false;
    }

    /**
     * Check if todo is deleted
     */
    public static function isTodoDeleted($item)
    {
        // check if key exist
        if (isset($item['deleted_at'])) {
            // if key exist, check if key is null
            // if null, todo is not deleted
            // else todo is deleted
            return $item['deleted_at'] == null ? false : true;
        }
        // if key does not exist
        // todo is not deleted
        return false;
    }


    /**
     * Get methods with Post Request
     */

    public function fetchSuggestions($request)
    {
        $filter =  ['user_id' => $request->query('member_id')];
        $result = Response::checkAndServe($this->httpRepository->findWhereWithPost($filter));
        $suggestions = [];

        return response($result);

        if (isset($result['status']) && isset($result['data']) && $result['data'] !== null) {
            return response()->json(["message" => AppConstants::MSG_404], AppConstants::STATUS_NOT_FOUND);
        } elseif ($result['data'] === null) {
            return response()->json(
                [
                    'status' => AppConstants::MSG_200,
                    'type' => 'suggections', 'data' => $suggestions
                ],
                AppConstants::STATUS_OK
            );
        }

        foreach ($result as  $todo) {
            $suggestions[$todo['title']] =  $todo['title'];
            $suggestions[$todo['description']] =  $todo['description'];
            foreach ($todo['tasks'] as  $task) {
                $suggestions[$todo['_id']] =  $task['title'];
            }
        }

        return response()->json([
            'status' => AppConstants::MSG_200,
            'type' => 'suggections', 'data' => $suggestions
        ], AppConstants::STATUS_OK);
    }


    public function fetchUserTodo($request)
    {
        $activeTodo = [];
        $filter =  ['user_id' => $request->query('user_id')];
        $result = Response::checkAndServe($this->httpRepository->findWhereWithPost($filter));

        return response($request);

        if (isset($result['status']) && isset($result['data']) && $result['data'] !== null) {
            return response()->json(["message" => AppConstants::MSG_404], AppConstants::STATUS_NOT_FOUND);
        } elseif ($result['data'] === null) {
            return response()->json(
                [
                    'status' => AppConstants::MSG_200,
                    'type' => 'suggections', 'data' => $activeTodo
                ],
                AppConstants::STATUS_OK
            );
        }

        for ($i = 0; $i < count($result); $i++) {
            if (!isset($result[$i]['deleted_at']) && (!isset($result[$i]['archived_at']) || $result[$i]['archived_at'] == null)) {
                array_push($activeTodo, $result[$i]);
            }
        }

        return response()->json([
            'status' => 'success',
            'type' => 'Todo Collection',
            'count' => count($activeTodo), 'data' => $activeTodo
        ], AppConstants::STATUS_OK);
    }
}
