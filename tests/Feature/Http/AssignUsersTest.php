<?php

namespace Tests\Feature\Http;

use App\Services\TodoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssignUsersTest extends TestCase
{


    public function test_collaborator_is_added_to_a_todo()
    {
        $this->withoutExceptionHandling();

        $todoServ = new TodoService();
        // We want to get a todo by it id
        $todo = $todoServ->find('6154eb8c7f0874785c51cdf4');


        // we want to assert that 404 is return when TODO is not found

        // We want to check that the action-performer has admin status, 1

        //

        // 
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
