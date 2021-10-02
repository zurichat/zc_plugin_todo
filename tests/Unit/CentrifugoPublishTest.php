<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\Rtc\Centrifugo;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CentrifugoPublishTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_centrifugo_publish_test()
    {
        $centrifuge = new Centrifugo;

        //test for publishing to room
        $responseFromRoom = $centrifuge->publishToRoomChannel('testchannel', ['test' => 'unit test'], "Task", "create");

        // response must be an empty array
        $this->assertSame([], $responseFromRoom['result'], 'passed publshing to room channel');

        //test for publishing to common room
        $responseFromRoom = $centrifuge->publishToCommonRoom(['test' => 'unit test'], 'testchannel', null, "create");

        // response must be an empty array
        $this->assertSame([], $responseFromRoom['result'], 'passed publshing to common room channel');
    }
}
