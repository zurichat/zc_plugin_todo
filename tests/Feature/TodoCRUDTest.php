<?php

namespace Tests\Feature;

use stdClass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoCRUDTest extends TestCase
{

   protected $organisation_id = '?organisation_id=614679ee1a5607b13c00bcb7';

   protected $user_id = '614b453144a9bd81cedc0b25';
    /**
     * create a todo
     *
     * @return void
     */
    public function test_create_todo()
    {
        $response = $this->postJson('/api/v1/create-todo'. $this->organisation_id .'',
        [
            "title" => "Test Case",
            "type" => "public",
            "user_id" => "614b453144a9bd81cedc0b25"
        ]);
        $response->assertStatus(200)
                ->assertJson([
                    "status" => "success",
                    "type" => "Todo",
                    "data" => [
                        '_id' => $response['data']['_id']
                    ]
                ]);
    }

    public function test_create_todo_endpoint_validate_title()
    {
      $response = $this->postJson('/api/v1/create-todo'. $this->organisation_id .'',
        [
            "title" => ""
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(
           ["title"]
        );
    }

     public function test_create_todo_endpoint_validate_user_id()
    {
        $this->postJson('/api/v1/create-todo'. $this->organisation_id .'',
        [
            "user_id" => ""
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(
           ["user_id"]
        );
    }

    public function test_create_todo_endpoint_validate_type()
    {
        $this->postJson('/api/v1/create-todo'. $this->organisation_id .'',
        [
            "type" => ""
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(
           ["type"]
        );
    }

    public function test_get_user_todo()
    {
        $response = $this->getJson('/api/v1/todo/615072e9dfe7da5d9f90ae8a/'. $this->user_id .'/show'. $this->organisation_id .'');
        $response->assertStatus(200)
                ->assertJson([
                    "_id" => $response['_id'],
                    "channel" => $response['channel'],
                    "collaborators" => [],
                    "created_at" => $response['created_at'],
                    "labels" => [],
                    "title" => $response['title'],
                    "tasks" => [],
                    "type" => $response['type']
                ]);

    }

    public function test_delete_todo()
    {
        $response = $this->deleteJson('/api/v1/todo/615072e9dfe7da5d9f90ae8a/delete/'. $this->user_id . $this->organisation_id .'');
        $response->assertStatus(200);

    }

    public function test_update_todo()
    {
        $response = $this->putJson('/api/v1/todo-update/615072e9dfe7da5d9f90ae8a/614b453144a9bd81cedc0b25?organisation_id=614679ee1a5607b13c00bcb7',[
            "title" => "updated title",
            "type" => "public"
        ]);
        // dd($response);
        $response->assertStatus(200);
        $response->assertJson([
                    "message" => "Todo updated successfully",
                    "data" => [
                        "matched_documents" => 1,
                        "modified_documents" => 1
                    ]
                ]);
    }

}
