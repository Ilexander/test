<?php

namespace Tests\Unit\Repositories\Category;

use App\Http\Requests\Category\CategoryAllRequest;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryDeleteRequest;
use App\Http\Requests\Category\CategoryInfoRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\User;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\Factories\CategoryFactory;
use Tests\Factories\UserFactory;
use Tests\TestCase;
use Tests\Traits\ValidationTrait;

class CategoryRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    use ValidationTrait;

    private CategoryRepository $categoryRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->categoryRepository = new CategoryRepository(new Category());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $category = CategoryFactory::new()->create();

        $all = new CategoryAllRequest();

        /** @var Category $item */
        foreach ($this->categoryRepository->all($all) as $item) {

            $this->checkEquals(
                $category,
                $item,
                [
                    'user_id',
                    'name',
                    'description',
                    'image_url',
                    'sort',
                    'status',
                ]
            );
        }

        $this->assertTrue(true);
    }

    public function testInfo()
    {
        $user = UserFactory::new()->create();
        Auth::shouldReceive('user')->andReturn($user);
        $category = CategoryFactory::new()->create([
            'user_id' => $user->id
        ]);

        $this->checkIsset($category, $user);
    }

    public function testAdd()
    {
        $user = UserFactory::new()->create();
        Auth::shouldReceive('user')->andReturn($user);

        $insertArray = [
            'user_id'   => $user->id,
            'name'  => Str::random(32),
            'description'   => Str::random(32),
            'image' => Str::random(32),
            'sort' => random_int(1, 9999999),
            'status' => true
        ];

        $create = new CategoryCreateRequest();
        $create->merge($insertArray);

        /** @var Category $category */
        $category = $this->categoryRepository->add($create);

        $this->assertEquals($insertArray['user_id'], $category->user_id);
        $this->assertEquals($insertArray['name'], $category->name);
        $this->assertEquals($insertArray['description'], $category->description);
//        $this->assertEquals($insertArray['image'], $category->image_url);
        $this->assertEquals($insertArray['sort'], $category->sort);
        $this->assertEquals($insertArray['status'], $category->status);
    }

    public function testDelete()
    {
        $user = UserFactory::new()->create();
        Auth::shouldReceive('user')->andReturn($user);
        $category = CategoryFactory::new()->create([
            'user_id' => $user->id
        ]);

        $this->checkIsset($category, $user);

        $delete = new CategoryDeleteRequest();
        $delete->merge([
            'id'    => $category->id,
            'user_id'   => $user->id,
        ]);

        $this->assertTrue($this->categoryRepository->delete($delete));
    }

    public function testUpdate()
    {
        $user = UserFactory::new()->create();
        Auth::shouldReceive('user')->andReturn($user);
        $category = CategoryFactory::new()->create([
            'user_id' => $user->id
        ]);

        $this->checkIsset($category, $user);

        $updateArray = [
            'id'    => $category->id,
            'user_id'   => $user->id,
            'name'  => Str::random(32),
            'description'   => Str::random(32),
            'image' => Str::random(32),
            'sort' => random_int(1, 9999999),
            'status' => true
        ];

        $update = new CategoryUpdateRequest();
        $update->merge($updateArray);

        $this->assertTrue($this->categoryRepository->update($update));

        $info = new CategoryInfoRequest();
        $info->merge([
            'id' => $category->id,
            'user_id' => $user->id
        ]);

        /** @var Category $result */
        $result = $this->categoryRepository->info($info);

        $this->assertEquals($updateArray['user_id'], $result->user_id);
        $this->assertEquals($updateArray['name'], $result->name);
        $this->assertEquals($updateArray['description'], $result->description);
//        $this->assertEquals($updateArray['image'], $result->image_url);
        $this->assertEquals($updateArray['sort'], $result->sort);
        $this->assertEquals($updateArray['status'], $result->status);
    }

    private function checkIsset(Category $category, User $user)
    {
        $info = new CategoryInfoRequest();
        $info->merge([
            'id' => $category->id,
            'user_id' => $user->id
        ]);

        $result = $this->categoryRepository->info($info);

        $this->checkEquals(
            $category,
            $result,
            [
                'user_id',
                'name',
                'description',
                'image_url',
                'sort',
                'status',
            ]
        );
    }
}
