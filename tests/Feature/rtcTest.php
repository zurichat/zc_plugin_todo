<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Repositories\Rtc\Centrifugo;

class rtcTest extends TestCase
{

    public function testRequiredFieldsToCreateTodo()
    {
        $this->json('POST', 'create-todo', ['Accept' => 'application/json'])->assertStatus(422)->assertJson([
                "title" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The title field is required."],
                ]
            ]);
    }

    // public function testSuccessfulCreateTodo()
    // {
    //     $userData = [
    //         "title" => $this->faker->text,
    //         'user_id' => "20150204112",
    //         'type' => "Public",
    //         'channel' => "todo-".rand(100000, 999999),
    //         "tasks" => [],
    //         "labels" => $this->faker->text,
    //         "collaborators" => [],
    //         "created_at" => now()
    //     ];

    //     $this->json('POST', 'create-todo', $userData, ['Accept' => 'application/json'])
    //     //$this->json('POST', $this->url . 'data/write', $userData, ['Accept' => 'application/json'])
    //         ->assertStatus(201)
    //         ->assertJsonStructure([
    //             "user" => [
    //                 'title',
    //                 'user_id',
    //                 'type',
    //                 'channel',
    //                 'tasks',
    //                 'labels',
    //                 'collaborators',
    //                 'created_at'
    //             ],
    //             "message"
    //         ]);
    // }

}
