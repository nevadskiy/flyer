<?php

namespace Tests\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlyersControllerTest extends TestCase
{
    /** @test */
    public function it_shows_the_form_to_create_a_new_flyer()
    {
        $response = $this->get('/flyers/create');

        $response->assertStatus(200);
    }
}
