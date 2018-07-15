<?php

namespace Tests\Controllers;

use App;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FlyersControllerTest extends TestCase
{
    /** @test */
    public function it_shows_the_form_to_create_a_new_flyer()
    {
        $user = factory(App\User::class)->create();
        $this->be($user);

        $response = $this->get(route('flyers.create'));

        $response->assertStatus(200);
    }
}
