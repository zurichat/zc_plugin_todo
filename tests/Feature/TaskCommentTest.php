<?php

namespace Tests\Feature;

use stdClass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskCommentTest extends TestCase
{

   protected $organisation_id = '?organisation_id=614679ee1a5607b13c00bcb7';

   protected $user_id = '614b453144a9bd81cedc0b25';

   protected $task_id = '614b453144a9bd81cedc0b25';

   protected $comment_id = '614b453144a9bd81cedc0b25';

   protected $channel = '614b453144a9bd81cedc0b25';
    /**
     * create a comment
     *
     * @return void
     */
    public function test_create_comment()
    {
        $data = [
                    "body" => "Random comment showing here",
                    "task_id" => "614b453144a9bd81cedc0b25",
                    "user_id" => "614b453144a9bd81cedc0b25"
                ];
        $response = $this->postJson('/api/v1/add-comment/'.$this->task_id. $this->organisation_id . '', $data);
        // dd($response);
        //push it and contact someone who can test it and give you feeback, even the previous test isn't passing
        // all this test can not pass, so you have to contact someone who do run the test to look at it and give you feed back
        $response->assertStatus(200)
                ->assertJson([
                    "status" => "success",
                    "type" => $response['type'],
                    "data" => [
                        '_id' => $response['data']['_id'],
                        'user_id' => $response['data']['user_id'],
                        'task_id' => $response['data']['task_id'],
                        'body' => $response['data']['body']

                    ]
                ]);
    }

    public function test_create_comment_endpoint_validate_body()
    {

        $data = [
            "task_id" => "614b453144a9bd81cedc0b25",
            "body" => "make a comment here"
        ];
      $response = $this->postJson('/api/v1/add-comment/' . $data['task_id'] . $this->organisation_id . '', $data);
        $response->assertStatus(422);
        dd($response);
        $response->assertJsonValidationErrors(
           ["body"]
        );
    }

    public function test_create_todo_endpoint_validate_user_id()
    {
        $data = [
            "task_id" => "614b453144a9bd81cedc0b25",
            "user_id" => "614b453144a9bd81cedc0b25"
        ];
        $this->postJson('/api/v1/add-comment/' .$data->task_id. $this->organisation_id . '', $data)
        ->assertStatus(422)
        ->assertJsonValidationErrors(
           ["user_id"]
        );
    }

    public function test_create_todo_endpoint_validate_task_id()
    {
        $data = [
            "task_id" => "614b453144a9bd81cedc0b25",
            "user_id" => "614b453144a9bd81cedc0b25"
        ];
        $this->postJson('/api/v1/add-comment/' .$data->task_id . $this->organisation_id .'', $data)
        ->assertStatus(422)
        ->assertJsonValidationErrors(
           ["task_id"]
        );
    }

    public function test_create_todo_endpoint_validate_type()
    {
        $data = [
            "type" => "comments",
            "task_id" => "614b453144a9bd81cedc0b25",
            "user_id" => "614b453144a9bd81cedc0b25"
        ];
        $this->postJson('/api/v1/add-comment/' .$data->task_id .  $this->organisation_id .'', $data)
        ->assertStatus(422)
        ->assertJsonValidationErrors(
           ["type"]
        );
    }

    public function test_get_task_comment()
    {
        $response = $this->getJson('/api/v1/comment/'.$data->task_id . $this->user_id .'/show'. '/' . $this->organisation_id . '');
        $response->assertStatus(200)
                ->assertJson([
                    "_id" => $response['_id'],
                    "channel" => $response['channel'],
                    "collaborators" => [],
                    "created_at" => $response['created_at'],
                    "labels" => [],
                    "body" => $response['body'],
                    "tasks" => [],
                    "type" => $response['type']
                ]);

    }

    public function test_delete_comment()
    {
        $response = $this->deleteJson('/api/v1/delete-comment/' .$data->task_id .'/'. $this->user_id . $this->organisation_id . '');
        $response->assertStatus(200);

    }

    public function test_update_comment()
    {
        $data = [
            "body" => 'comment update',
            "type" => "comments",
            "task_id" => "614b453144a9bd81cedc0b25",
            "user_id" => "614b453144a9bd81cedc0b25"
        ];
        $response = $this->putJson('/api/v1/update-comment/' .$data->comment_id .'/' . $data->channel . '/?organisation_id=614679ee1a5607b13c00bcb7', $data);

        $response->assertStatus(200);
        $response->assertJson([
                    "message" => "Comment updated successfully",
                    "data" => [
                        "matched_documents" => 1,
                        "modified_documents" => 1
                    ]
                ]);
    }

}
