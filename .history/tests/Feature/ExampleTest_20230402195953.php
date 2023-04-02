<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_mainpage_show_correct_info(): void
    {
        Http::fake([]);

        $response = $this->get(route('movies.index'));

        $response->assertStatus(200);
    }
}
