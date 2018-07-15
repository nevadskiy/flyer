<?php

namespace Tests\Feature;

use Mockery as m;
use App;
use Illuminate\Http\UploadedFile;
use App\Services\PhotoUploader;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/** Stub functions */
require_once __DIR__ . '/' . './../Stubs/functions.php';

class AddPhotoToFlyerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_process_form_of_add_photo_to_a_flyer()
    {
        $flyer = factory(App\Flyer::class)->create();

        // Mock file bcuz we dont actually upload it during test
        $file = m::mock(UploadedFile::class, [
            'getClientOriginalName' => 'foo',
            'getClientOriginalExtension' => 'jpg',
        ]);

        // Mock thumb bcuz we dont actually want to test
        // generating thumb from another mock above
        $file->shouldReceive('move')
            ->once()
            ->with('photos/flyers', 'nowfoo.jpg');

        $thumbnail = m::mock(App\Thumbnail::class);

        $thumbnail->shouldReceive('make')
            ->once()
            ->with('photos/flyers/nowfoo.jpg', 'photos/flyers/tn-nowfoo.jpg');

        $uploader = new PhotoUploader($flyer, $file, $thumbnail);

        $uploader->save();

        $this->assertCount(1, $flyer->photos);
    }
}