<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_gets_collection_from_cache_successfully()
    {
        $response = $this->get('/api/vi/all-todo?user_id=614b453144a9bced34546f&organisation_id=614679ee1a5607b13c0dvdvd7');

        $response->assertStatus(200);
    }
}
