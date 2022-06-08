<?php

namespace Tests\Unit\Services\Category;

use App\Http\Requests\Category\CategoryAllInterface;
use App\Http\Requests\Category\CategoryCreateInterface;
use App\Http\Requests\Category\CategoryDeleteInterface;
use App\Http\Requests\Category\CategoryInfoInterface;
use App\Http\Requests\Category\CategoryUpdateInterface;
use App\Interfaces\Repositories\CategoryInterface;
use App\Models\Category;
use App\Services\Category\CategoryService;
use App\Services\Image\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\CategoryFactory;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Category $category;

    private CategoryService $categoryService;


    protected function setUp(): void
    {
        parent::setUp();

        $this->category = CategoryFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->category);

        $repo = $this->createMock(CategoryInterface::class);
        $repo->method('all')->willReturn($collection);
        $repo->method('info')->willReturn($this->category);
        $repo->method('add')->willReturn($this->category);
        $repo->method('update')->willReturn(true);
        $repo->method('delete')->willReturn(true);

        $imageService = $this->createMock(ImageService::class);
        $imageService->method('saveImage')->willReturn('image.png');

        $this->categoryService = new CategoryService($repo, $imageService);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testList()
    {
        $list = $this->createMock(CategoryAllInterface::class);
        $result = $this->categoryService->list($list);

        /** @var Category $item */
        foreach ($result as $item) {
            $this->assertEquals($this->category->user_id, $item->user_id);
            $this->assertEquals($this->category->name, $item->name);
            $this->assertEquals($this->category->description, $item->description);
            $this->assertEquals($this->category->image_url, $item->image_url);
            $this->assertEquals($this->category->sort, $item->sort);
            $this->assertEquals($this->category->status, $item->status);
        }
    }

    public function testInfo()
    {
        $info = $this->createMock(CategoryInfoInterface::class);
        /** @var Category $result */
        $result = $this->categoryService->info($info);

        $this->assertEquals($this->category->user_id, $result->user_id);
        $this->assertEquals($this->category->name, $result->name);
        $this->assertEquals($this->category->description, $result->description);
        $this->assertEquals($this->category->image_url, $result->image_url);
        $this->assertEquals($this->category->sort, $result->sort);
        $this->assertEquals($this->category->status, $result->status);
    }

    public function testCreate()
    {
        $create = $this->createMock(CategoryCreateInterface::class);
        /** @var Category $result */
        $result = $this->categoryService->create($create);

        $this->assertEquals($this->category->user_id, $result->user_id);
        $this->assertEquals($this->category->name, $result->name);
        $this->assertEquals($this->category->description, $result->description);
        $this->assertEquals($this->category->image_url, $result->image_url);
        $this->assertEquals($this->category->sort, $result->sort);
        $this->assertEquals($this->category->status, $result->status);
    }

    public function testUpdate()
    {
        $update = $this->createMock(CategoryUpdateInterface::class);

        $this->assertTrue($this->categoryService->update($update));
    }

    public function testDelete()
    {
        $delete = $this->createMock(CategoryDeleteInterface::class);

        $this->assertTrue($this->categoryService->delete($delete));
    }
}
