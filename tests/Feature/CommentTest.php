<?php

namespace Tests\Feature;

use App\Constants\AppConstants;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CommentTest extends TestCase
{
    protected $todoId = "61572da4d56dd3c4d8a965d7";
    protected $requestParam = "?user_id=614f089fe35bb73a77bc2b77&organisation_id=614679ee1a5607b13c00bcb7";
    protected $userId = "614f089fe35bb73a77bc2b77";
    protected $taskId = "a1c29606-1c89-428c-b65c-cd9acf2c6bca";

    public function test_commentCreation_validation_works_for_commentBody_omission()
    {
        // We attempt to build the collaborator object without the colloaborator_id 
        $data = [
            "body" => ""
        ];
        //Hit the endpoint to add collaborator to a todo 
        $this->json('POST', 'api/v1/add-comment/' . $this->todoId . $this->requestParam, $data)
            //assert a 422 response code
            ->assertStatus(422)
            //we assert collaborator_id validation error
            ->assertJsonValidationErrors(["body"]);
    }

    public function test_commentCreation_validation_works_for_taskID_omission()
    {
        // We attempt to build the collaborator object without the colloaborator_id 
        $data = [
            "task_id" => ""
        ];
        //Hit the endpoint to add collaborator to a todo 
        $this->json('POST', 'api/v1/add-comment/' . $this->todoId . $this->requestParam, $data)
            //assert a 422 response code
            ->assertStatus(422)
            //we assert collaborator_id validation error
            ->assertJsonValidationErrors(["task_id"]);
    }

    // public function test_comment_is_created()
    // {
    //     Http::fake();
    //     // first we define the data
    //     $data = [
    //         "user_id" => $this->userId,
    //         "task_id" => $this->taskId,
    //         "body" => "Chiamaka says hi"
    //     ];
    //     // hit the endpoint 

    //     $response = Http::post('POST', 'api/v1/add-comment/' . $this->todoId . $this->requestParam, $data)



    //     $this->json('POST', 'api/v1/add-comment/' . $this->todoId . $this->requestParam, $data)
    //         // assert the response code  200
    //         ->assertStatus(200)
    //         //assert that the structure of the Json response matches the exact response structure
    //         ->assertJsonStructure([
    //             'status',
    //             'type',
    //             'data'
    //         ]);
    // }
}
