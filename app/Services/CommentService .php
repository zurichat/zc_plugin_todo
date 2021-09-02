<?php

namespace App\Services;

use App\Repositories\CommentRepository;

class CommentService extends \App\Providers\AppServiceProvider
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->commentRepository->all();
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->commentRepository->create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->commentRepository->find($id);
    }

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->commentRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->commentRepository->delete($id);
    }
}
