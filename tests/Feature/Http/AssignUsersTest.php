<?php

namespace Tests\Feature\Http;

use App\Services\TodoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssignUsersTest extends TestCase
{

    protected $todoId = "6154eba27f0874785c51cdf5";
    protected $userId = "614f089fe35bb73a77bc2b77";
    protected $requestParam = "?user_id=614f089fe35bb73a77bc2b77&organisation_id=614679ee1a5607b13c00bcb7";


    public function test_collaborator_is_added_to_a_todo()
    {
        $this->withoutExceptionHandling();
        $data = ['user_id' => $this->userId, 'admin_status' => '0'];
        $this->json('PUT', 'api/v1/assign-collaborators/' . $this->todoId . $this->requestParam, $data)
            ->assertStatus(200)
            ->assertJson([]);
    }


    public function test_required_field_for_adding_collaborators()
    {
        $this->withoutExceptionHandling();
        $this->json('PUT', 'api/v1/assign-collaborators/' . $this->todoId . $this->requestParam, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "user_id" => ["The name field is required."],
                    "task_id" => ["The email field is required."],
                    "body" => ["The password field is required."],
                ]
            ]);
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
