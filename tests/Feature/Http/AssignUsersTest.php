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
            //assert that the structure of the Json response matches the exected response structure
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
        $collaboratorData = [
            'collaborator_id' => $this->collaborator_id,
            'user_id' => $this->userId
        ];
        $response = $this->json('PUT', 'api/v1/assign-collaborators/' . $this->todoId . $this->requestParam, $collaboratorData)
            ->assertStatus(200);
    }







    // public function test_collaborator_is_added_to_a_todo()
    // {
    //     

    //     $todo = $this->app->make(TodoService::class)->find("6154eba27f0874785c51cdf5");

    //     $todo = $todoServ->find('6154eb8c7f0874785c51cdf4');


    //     // we want to assert that 404 is return when TODO is not found

    //     // We want to check that the action-performer has admin status, 1

    //     //

    //     // 
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
}
