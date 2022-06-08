<?php

namespace Tests\Unit\Services\Language;

use App\Http\Requests\Language\LanguageAllInterface;
use App\Http\Requests\Language\LanguageCreateInterface;
use App\Http\Requests\Language\LanguageDeleteInterface;
use App\Http\Requests\Language\LanguageInfoInterface;
use App\Http\Requests\Language\LanguageUpdateInterface;
use App\Interfaces\Repositories\LanguageInterface;
use App\Models\Language;
use App\Services\Image\ImageService;
use App\Services\Language\LanguageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\Factories\LanguageFactory;

class LanguageServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Language $language;
    private LanguageService $languageService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->language = LanguageFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->language);

        $repo = $this->createMock(LanguageInterface::class);
        $repo->method('all')->willReturn($collection);
        $repo->method('info')->willReturn($this->language);
        $repo->method('create')->willReturn($this->language);
        $repo->method('update')->willReturn(true);
        $repo->method('delete')->willReturn(true);

        $imageService = $this->createMock(ImageService::class);
        $imageService->method('saveImage')->willReturn('image.png');

        $this->languageService = new LanguageService($repo, $imageService);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $all = $this->createMock(LanguageAllInterface::class);
        $result = $this->languageService->all($all);

        /** @var Language $item */
        foreach ($result as $item) {
            $this->assertEquals($this->language->name, $item->name);
            $this->assertEquals($this->language->alt, $item->alt);
            $this->assertEquals($this->language->supported_countries, $item->supported_countries);
            $this->assertEquals($this->language->status, $item->status);
            $this->assertEquals($this->language->image_url, $item->image_url);
        }
    }

    public function testInfo()
    {
        $info = $this->createMock(LanguageInfoInterface::class);
        /** @var Language $result */
        $result = $this->languageService->info($info);

        $this->assertEquals($this->language->name, $result->name);
        $this->assertEquals($this->language->alt, $result->alt);
        $this->assertEquals($this->language->supported_countries, $result->supported_countries);
        $this->assertEquals($this->language->status, $result->status);
        $this->assertEquals($this->language->image_url, $result->image_url);
    }

    public function testCreate()
    {
        Storage::fake('public');
        $uploadedFile = UploadedFile::fake()->image('avatar.jpg');

        $create = $this->createMock(LanguageCreateInterface::class);
        $create->method('getImage')->willReturn($uploadedFile);
        /** @var Language $result */
        $result = $this->languageService->create($create);

        $this->assertEquals($this->language->name, $result->name);
        $this->assertEquals($this->language->alt, $result->alt);
        $this->assertEquals($this->language->supported_countries, $result->supported_countries);
        $this->assertEquals($this->language->status, $result->status);
        $this->assertEquals($this->language->image_url, $result->image_url);
    }

    public function testUpdate()
    {
        $update = $this->createMock(LanguageUpdateInterface::class);
        $this->assertTrue($this->languageService->update($update));
    }

    public function testDelete()
    {
        $delete = $this->createMock(LanguageDeleteInterface::class);
        $this->assertTrue($this->languageService->delete($delete));
    }
}
