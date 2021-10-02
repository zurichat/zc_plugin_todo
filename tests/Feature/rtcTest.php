<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Repositories\Rtc\Centrifugo;

class rtcTest extends TestCase
{
    protected $org_id = '?organisation_id=614679ee1a5607b13c00bcb7';

   protected $user_id = '614b453144a9bd81cedc0b25';

    public function testToRealTimeUpdateOnCreateTodo()
    {
        $userData = [
            "title" => "Random title showing here",
            "type" => "public",
            "user_id" => "614b453144a9bd81cedc0b25"
        ];
        $response = $this->postJson('/api/v1/create-todo'. $this->org_id .'', $userData);
        $response->assertStatus(200)->assertJson([
            "status" => "success",
            "type" => $response['type'],
            "data" => [
                '_id' => $response['data']['_id'],
                'title' => $response['data']['title'],
                'user_id' => $response['data']['user_id']
            ]
            //TO DO publish t room
        ]);
    }

    public function testToRealTimeUpdateOnUpdateTodo()
    {
        $userData = [
            "title" => 'title',
            "type" => "Public"
        ];
        $response = $this->putJson('/api/v1/todo-update/615072e9dfe7da5d9f90ae8a/614b453144a9bd81cedc0b25?organisation_id=614679ee1a5607b13c00bcb7', $userData);

        $response->assertStatus(200);
        $response->assertJson([
                    "message" => "Todo updated successfully",
                    "data" => [
                        "matched_documents" => 1,
                        "modified_documents" => 1
                    ]
        //TODO publish to room
        ]);
    }
}
