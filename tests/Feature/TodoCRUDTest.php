<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
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
                ->dump()
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
        ->dump()
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


}
