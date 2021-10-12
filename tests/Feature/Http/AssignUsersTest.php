<?php

namespace Tests\Feature\Http;

use App\Services\TodoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssignUsersTest extends TestCase
{

    protected $todoId = "61572da4d56dd3c4d8a965d7";
    protected $userId = "614f089fe35bb73a77bc2b77";
    protected $userWithoutAdminStatus = "614f089fe35bb73a77bc2b76";
    protected $collaborator_id = "614f089fe35bb73a77bc2abc";
    protected $requestParam = "?user_id=614f089fe35bb73a77bc2b77&organisation_id=614679ee1a5607b13c00bcb7";

    public function test_collaborator_validation_works_for_collaboratorId_omission()
    {
        // We attempt to build the collaborator object without the colloaborator_id 
        $collaboratorData = [
            "collaborator_id" => ""
        ];
        //Hit the endpoint to add collaborator to a todo 
        $this->json('PUT', 'api/v1/assign-collaborators/' . $this->todoId . $this->requestParam, $collaboratorData)
            //assert a 422 response code
            ->assertStatus(422)
            //we assert collaborator_id validation error
            ->assertJsonValidationErrors(["collaborator_id"]);
    }

    public function test_collaborator_validation_works_for_adminStatus_omission()
    {
        // We attempt to build the collaborator object without the admin_status 
        $collaboratorData = [
            "admin_status" => ""
        ];
        //Hit the endpoint to add collaborator to a todo 
        $this->json('PUT', 'api/v1/assign-collaborators/' . $this->todoId . $this->requestParam, $collaboratorData)
            //assert a 422 response code
            ->assertStatus(422)
            //we assert admin_status validation error
            ->assertJsonValidationErrors(["admin_status"]);
    }

    public function test_collaborator_validation_works_for_userId_omission()
    {
        // We attempt to build the data without entery on the user_id on the user_id field 
        $collaboratorData = [
            "user_id" => ""
        ];
        //Hit the endpoint to add collaborator to a todo 
        $this->json('PUT', 'api/v1/assign-collaborators/' . $this->todoId . $this->requestParam, $collaboratorData)
            //assert a 422 response code
            ->assertStatus(422)
            //we assert user_id validation error
            ->assertJsonValidationErrors(["user_id"]);
    }

    public function test_admin_status_checker_works_when_attempting_to_add_collaborators()
    {
        // We simulate a user, with no admin previlege, attempting to add collaborators to a todo
        // We attempt making the request usin $userWithoutAdminStatus who is not an admin on the Test TODO
        $this->withoutExceptionHandling();
        //Define a collaborator to be added to a todo and include the action performer user_id
        //the performer user_id is without admin previlege
        $collaboratorData = [
            'collaborator_id' => $this->collaborator_id,
            'admin_status' => '0',
            'user_id' => $this->userWithoutAdminStatus
        ];
        //Hit the endpoint to add collaborator to a todo 
        $response = $this->json('PUT', 'api/v1/assign-collaborators/' . $this->todoId . $this->requestParam, $collaboratorData)
            //assert the response status is 401 
            ->assertStatus(401)
            //assert the response message is "Lack authorization"    
            ->assertJson(['message' => 'Lack authorization']);
    }


    public function test_collaborator_is_added_to_a_todo()
    {
        // simulate adding collaborator to a todo using a test TODO, $todoId

        $this->withoutExceptionHandling();

        //Define a collaborator to be added to a todo and include the action performer's user_id
        //the performer has admin previlege
        $data = [
            'collaborator_id' => $this->collaborator_id,
            'admin_status' => '0',
            'user_id' => $this->userId
        ];

        //Hit the endpoint to add collaborator to a todo 
        $response = $this->json('PUT', 'api/v1/assign-collaborators/' . $this->todoId . $this->requestParam, $data)
            //assert the response status is 200 
            ->assertStatus(200)
            //assert that the added collaborator is now contained in the collaborators array of the todo response 
            ->assertJsonFragment(['collaborator_id' => $this->collaborator_id, 'admin_status' => '0'])
            //assert that the structure of the Json response matches the exact response structure
            ->assertJsonStructure([
                "status",
                "type",
                "data" => [
                    '_id', "channel", "collaborators", "created_at",
                    "labels", "tasks", "title", "type", "user_id"
                ]
            ]);
    }

    public function test_collaborator_is_removed_from_a_todo()
    {
        $this->withoutExceptionHandling();
        //Define a collaborator to be removed from the collaborator array
        //Add the performaer user_id
        $collaboratorData = [
            'collaborator_id' => $this->collaborator_id,
            'admin_status' => '0',
            'user_id' => $this->userId
        ];
        //Hit the endpoint to remove collaborator from a todo
        $this->json('PUT', 'api/v1/remove-collaborators/' . $this->todoId . $this->requestParam, $collaboratorData)
            //assert the response status is 200     
            ->assertStatus(200)
            //assert that the collaborator is not contained in the collaborators array of the todo response 
            ->assertJsonMissing(['collaborator_id' => $this->collaborator_id,]);
    }

    public function test_fetch_collaborators_on_a_todo()
    {
        $this->withoutExceptionHandling();

        //Hit the endpoint to remove collaborator from a todo
        $response = $this->json('GET', 'api/v1/get-collaborators/' . $this->todoId . $this->requestParam)
            //assert the response status is 200 
            ->assertStatus(200)


            // Assert JSON structure of response
            ->assertJsonStructure([
                "status",
                "type",
                "count",
                "data"
            ]);
    }
}
