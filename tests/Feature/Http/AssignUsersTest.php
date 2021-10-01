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
    protected $collaborator_id = "614f089fe35bb73a77bc2bcd";
    protected $requestParam = "?user_id=614f089fe35bb73a77bc2b77&organisation_id=614679ee1a5607b13c00bcb7";


    public function test_collaborator_is_added_to_a_todo()
    {
        $this->withoutExceptionHandling();

        $data = ['collaborator_id' => $this->collaborator_id, 'admin_status' => '0'];
        $this->json('PUT', 'api/v1/assign-collaborators/' . $this->todoId . $this->requestParam, $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "type",
                "data" => [
                    '_id',
                    "channel",
                    "collaborators",
                    "created_at",
                    "labels",
                    "tasks",
                    "title",
                    "type",
                    "user_id"
                ]
            ]);
    }

    public function test_collaborator_is_removed_from_a_todo()
    { }




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
