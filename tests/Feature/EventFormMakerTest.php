<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventFormMakerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //TODO: test livewire
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
