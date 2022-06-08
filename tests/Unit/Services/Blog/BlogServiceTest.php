<?php

namespace Tests\Unit\Services\Blog;

use App\DTO\Translation\TranslationItemDTO;
use App\Http\Requests\Blog\BlogAllInterface;
use App\Http\Requests\Blog\BlogCreateInterface;
use App\Http\Requests\Blog\BlogDeleteInterface;
use App\Http\Requests\Blog\BlogInfoInterface;
use App\Http\Requests\Blog\BlogUpdateInterface;
use App\Interfaces\Repositories\BlogInterface;
use App\Interfaces\Repositories\LanguageInterface;
use App\Interfaces\Repositories\TranslationInterface;
use App\Models\Blog;
use App\Models\Language;
use App\Models\Translation;
use App\Services\Blog\BlogService;
use App\Services\Image\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\Factories\TranslationFactory;
use Tests\TestCase;
use Tests\Factories\BlogFactory;
use Tests\Factories\LanguageFactory;

class BlogServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Blog $blog;

    private Language $language;

    private BlogService $blogService;

    private Translation $translation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->blog = BlogFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->blog);

        $repo = $this->createMock(BlogInterface::class);
        $repo->method('all')->willReturn($collection);
        $repo->method('info')->willReturn($this->blog);
        $repo->method('create')->willReturn($this->blog);
        $repo->method('update')->willReturn(true);
        $repo->method('delete')->willReturn(true);

        $imageService = $this->createMock(ImageService::class);
        $imageService->method('saveImage')->willReturn('image.png');

        $this->language = LanguageFactory::new()->create();
        $collectionLanguages = new Collection();
        $collectionLanguages->add($this->language);

        $languageRepo = $this->createMock(LanguageInterface::class);
        $languageRepo->method('all')->willReturn($collectionLanguages);
        $languageRepo->method('info')->willReturn($this->language);
        $languageRepo->method('create')->willReturn($this->language);
        $languageRepo->method('update')->willReturn(true);
        $languageRepo->method('delete')->willReturn(true);

        $this->translation = TranslationFactory::new()->create([
            'language_id' => $this->language->id
        ]);

        $translationRepo = $this->createMock(TranslationInterface::class);
        $translationRepo->method('create')->willReturn($this->translation);
        $translationRepo->method('deleteByEntityData')->willReturn(true);

        $this->blogService = new BlogService($repo, $imageService, $languageRepo, $translationRepo);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $all = $this->createMock(BlogAllInterface::class);

        $result = $this->blogService->all($all);

        /** @var Blog $item */
        foreach ($result as $item) {
            $this->assertEquals($this->blog->user_id, $item->user_id);
            $this->assertEquals($this->blog->title, $item->title);
            $this->assertEquals($this->blog->category, $item->category);
            $this->assertEquals($this->blog->url_slug, $item->url_slug);
            $this->assertEquals($this->blog->image_url, $item->image_url);
            $this->assertEquals($this->blog->content, $item->content);
            $this->assertEquals($this->blog->meta_keywords, $item->meta_keywords);
            $this->assertEquals($this->blog->meta_description, $item->meta_description);
            $this->assertEquals($this->blog->sort, $item->sort);
            $this->assertEquals($this->blog->status, $item->status);
        }
    }

    public function testInfo()
    {
        $info = $this->createMock(BlogInfoInterface::class);

        /** @var Blog $result */
        $result = $this->blogService->info($info);

        $this->assertEquals($this->blog->user_id, $result->user_id);
        $this->assertEquals($this->blog->title, $result->title);
        $this->assertEquals($this->blog->category, $result->category);
        $this->assertEquals($this->blog->url_slug, $result->url_slug);
        $this->assertEquals($this->blog->image_url, $result->image_url);
        $this->assertEquals($this->blog->content, $result->content);
        $this->assertEquals($this->blog->meta_keywords, $result->meta_keywords);
        $this->assertEquals($this->blog->meta_description, $result->meta_description);
        $this->assertEquals($this->blog->sort, $result->sort);
        $this->assertEquals($this->blog->status, $result->status);
    }

    public function testCreate()
    {
        $create = $this->createMock(BlogCreateInterface::class);

        $create->method('getUserId')->willReturn(1);
        $transactionDTO = $this->createMock(TranslationItemDTO::class);
        $create->method('getTranslation')->willReturn($transactionDTO);
        $create->method('getCategory')->willReturn(Str::random());
        $create->method('getUrlSlug')->willReturn(Str::random());
        $image = $this->createMock(UploadedFile::class);
        $create->method('getImage')->willReturn($image);
        $create->method('getImageUrl')->willReturn(Str::random());
        $create->method('getMetaKeywords')->willReturn(Str::random());
        $create->method('getMetaDescription')->willReturn(Str::random());
        $create->method('getSort')->willReturn(1);
        $create->method('getStatus')->willReturn(true);

        /** @var Blog $result */
        $result = $this->blogService->create($create);

        $this->assertEquals($this->blog->user_id, $result->user_id);
        $this->assertEquals($this->blog->title, $result->title);
        $this->assertEquals($this->blog->category, $result->category);
        $this->assertEquals($this->blog->url_slug, $result->url_slug);
        $this->assertEquals($this->blog->image_url, $result->image_url);
        $this->assertEquals($this->blog->content, $result->content);
        $this->assertEquals($this->blog->meta_keywords, $result->meta_keywords);
        $this->assertEquals($this->blog->meta_description, $result->meta_description);
        $this->assertEquals($this->blog->sort, $result->sort);
        $this->assertEquals($this->blog->status, $result->status);
    }

    public function testUpdate()
    {
        $update = $this->createMock(BlogUpdateInterface::class);

        $update->method('getUserId')->willReturn(1);
        $transactionDTO = $this->createMock(TranslationItemDTO::class);
        $update->method('getTranslation')->willReturn($transactionDTO);
        $update->method('getCategory')->willReturn(Str::random());
        $update->method('getUrlSlug')->willReturn(Str::random());
        $image = $this->createMock(UploadedFile::class);
        $update->method('getImage')->willReturn($image);
        $update->method('getImageUrl')->willReturn(Str::random());
        $update->method('getMetaKeywords')->willReturn(Str::random());
        $update->method('getMetaDescription')->willReturn(Str::random());
        $update->method('getSort')->willReturn(1);
        $update->method('getStatus')->willReturn(true);

        $this->assertTrue($this->blogService->update($update));
    }

    public function testDelete()
    {
        $delete = $this->createMock(BlogDeleteInterface::class);

        $this->assertTrue($this->blogService->delete($delete));
    }
}
