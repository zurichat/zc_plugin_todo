<?php

namespace App\Services;

use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Http;

class TaskService extends \App\Providers\AppServiceProvider
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->taskRepository->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {

        return $this->taskRepository->create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->taskRepository->find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->taskRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->taskRepository->delete($id);
    }
//
//    public function addPost()
//    {
//        $post = Http::post('https://jsonplaceholder.typicode.com/posts', [
//            'userId' => 1,
//            'title' => 'New Post Title',
//            'body' => 'This is a new post description'
//        ]);
//        return $post->json();
//    }
}
