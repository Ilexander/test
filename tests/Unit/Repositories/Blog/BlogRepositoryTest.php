<?php

namespace Tests\Unit\Repositories\Blog;

use App\DTO\Blog\BlogItemDTO;
use App\Http\Requests\Blog\BlogAllRequest;
use App\Http\Requests\Blog\BlogDeleteRequest;
use App\Http\Requests\Blog\BlogInfoRequest;
use App\Models\Blog;
use App\Repositories\Blog\BlogRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\Factories\BlogFactory;
use Tests\Factories\UserFactory;
use Tests\TestCase;
use Tests\Traits\ValidationTrait;

class BlogRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    use ValidationTrait;

    private BlogRepository $blogRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->blogRepository = new BlogRepository(new Blog());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $blog = BlogFactory::new()->create();

        $all = new BlogAllRequest();

        /** @var Blog $item */
        foreach ($this->blogRepository->all($all) as $item) {
            $this->checkEquals(
                $blog,
                $item,
                [
                    "user_id",
                    "title",
                    "category",
                    "url_slug",
                    "image_url",
                    "content",
                    "meta_keywords",
                    "meta_description",
                    "sort",
                    "status",
                ]
            );
        }
    }

    public function testCreate()
    {
        $userId = UserFactory::new()->create()->id;
        $title = Str::random(32);
        $content = Str::random(32);
        $category = Str::random(32);
        $imageUrl = Str::random(32);
        $metaKeywords = Str::random(32);
        $metaDescription = Str::random(32);
        $status = true;
        $sort = random_int(1, 9999999);
        $urlSlug = Str::random(32);

        $create = new BlogItemDTO(
            $userId,
            $title,
            $content,
            $category,
            $imageUrl,
            $metaKeywords,
            $metaDescription,
            $status,
            $sort,
            $urlSlug
        );

        /** @var Blog $blog */
        $blog = $this->blogRepository->create($create);

        $this->assertEquals($userId, $blog->user_id);
        $this->assertEquals($title, $blog->title);
        $this->assertEquals($content, $blog->content);
        $this->assertEquals($imageUrl, $blog->image_url);
        $this->assertEquals($metaKeywords, $blog->meta_keywords);
        $this->assertEquals($metaDescription, $blog->meta_description);
        $this->assertEquals($status, $blog->status);
        $this->assertEquals($sort, $blog->sort);
        $this->assertEquals($urlSlug, $blog->url_slug);
    }

    public function testInfo()
    {
        $blog = BlogFactory::new()->create();

        $this->checkIsset($blog);

        $info = new BlogInfoRequest();
        $info->merge([
            'id' => 456789876
        ]);

        $this->assertNull($this->blogRepository->info($info));
    }

    public function testUpdate()
    {
        $user = UserFactory::new()->create();

        $blog = BlogFactory::new()->create([
            'user_id' => $user->id
        ]);

        $this->checkIsset($blog);

        $userId = $user->id;
        $title = Str::random(32);
        $content = Str::random(32);
        $category = Str::random(32);
        $imageUrl = Str::random(32);
        $metaKeywords = Str::random(32);
        $metaDescription = Str::random(32);
        $status = true;
        $sort = random_int(1, 9999999);
        $urlSlug = Str::random(32);

        $update = new BlogItemDTO(
            $userId,
            $title,
            $content,
            $category,
            $imageUrl,
            $metaKeywords,
            $metaDescription,
            $status,
            $sort,
            $urlSlug
        );

        $this->assertTrue($this->blogRepository->update($update, $blog->id));

        $info = new BlogInfoRequest();
        $info->merge([
            'id' => $blog->id
        ]);

        /** @var Blog $result */
        $result = $this->blogRepository->info($info);

        $this->assertEquals($userId, $result->user_id);
        $this->assertEquals($title, $result->title);
        $this->assertEquals($content, $result->content);
        $this->assertEquals($imageUrl, $result->image_url);
        $this->assertEquals($metaKeywords, $result->meta_keywords);
        $this->assertEquals($metaDescription, $result->meta_description);
        $this->assertEquals($status, $result->status);
        $this->assertEquals($sort, $result->sort);
        $this->assertEquals($urlSlug, $result->url_slug);
    }

    public function testDelete()
    {
        $blog = BlogFactory::new()->create();

        $this->checkIsset($blog);

        $delete = new BlogDeleteRequest();
        $delete->merge([
            'id' => $blog->id
        ]);

        $this->assertTrue($this->blogRepository->delete($delete));


        $info = new BlogInfoRequest();
        $info->merge([
            'id' => $blog->id
        ]);

        $this->assertNull($this->blogRepository->info($info));
    }

    private function checkIsset(Blog $blog)
    {
        $info = new BlogInfoRequest();
        $info->merge([
            'id' => $blog->id
        ]);

        /** @var Blog $result */
        $result = $this->blogRepository->info($info);

        $this->checkEquals(
            $blog,
            $result,
            [
                "user_id",
                "title",
                "category",
                "url_slug",
                "image_url",
                "content",
                "meta_keywords",
                "meta_description",
                "sort",
                "status",
            ]
        );
    }
}
