<?php

namespace Tests\Unit\Services\Image;

use Illuminate\Support\Facades\Storage;
use App\Services\Image\ImageService;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageServiceTest extends TestCase
{
    private ImageService $imageService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->imageService = new ImageService();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSaveImage()
    {
        Storage::fake('public');

        $uploadedFile = UploadedFile::fake()->image('avatar.jpg');

        $this->assertEquals('avatar.jpg', $this->imageService->saveImage($uploadedFile));
    }
}
