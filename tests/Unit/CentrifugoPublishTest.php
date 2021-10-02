<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\App;
use App\Services\TodoService;
use Exception;

class CentrifugoPublishTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_centrifugo_publish_test()
    {
      
        $service = App::make(TodoService::class);

        //test for publishing to room
        $responseFromRoom = $service->publishToRoomChannel('testchannel', ['test' => 'unit test'], "Task", "create");
        
        try {
            // response must be an empty array
            $this->assertSame([], $responseFromRoom['result']);
            print('passed publshing to room channel');
        } catch (Exception $ex) {
            print('failed publshing to room channel');
        } 

        //test for publishing to common room
        $responseFromRoom = $service->publishToCommonRoom(['test' => 'unit test'], 'testchannel', null, "create");
        
        try {
            // response must be an empty array
            $this->assertSame([], $responseFromRoom['result']);
            print('passed publshing to common room channel');
        } catch (Exception $ex) {
            print('failed publshing to common room channel');
        }
        
    }
}
