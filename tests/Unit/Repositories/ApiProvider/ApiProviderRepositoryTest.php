<?php

namespace Tests\Unit\Repositories\ApiProvider;

use App\Http\Requests\ApiProvider\ApiProviderAllRequest;
use App\Http\Requests\ApiProvider\ApiProviderCreateRequest;
use App\Http\Requests\ApiProvider\ApiProviderDeleteRequest;
use App\Http\Requests\ApiProvider\ApiProviderInfoRequest;
use App\Http\Requests\ApiProvider\ApiProviderUpdateRequest;
use App\Models\ApiProvider;
use App\Repositories\ApiProvider\ApiProviderRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\Factories\UserFactory;
use Tests\TestCase;
use Tests\Factories\ApiProviderFactory;
use Tests\Traits\ValidationTrait;

class ApiProviderRepositoryTest extends TestCase
{
    use DatabaseMigrations;
    use ValidationTrait;

    private ApiProviderRepository $apiProviderRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->apiProviderRepository = new ApiProviderRepository(new ApiProvider());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testList()
    {
        $apiProvider = ApiProviderFactory::new()->create();

        $all = new ApiProviderAllRequest();

        /** @var ApiProvider $item */
        foreach ($this->apiProviderRepository->list($all) as $item) {
            $this->checkEquals(
                $apiProvider,
                $item,
                [
                    'user_id',
                    'name',
                    'url',
                    'key',
                    'type',
                    'balance',
                    'currency_code',
                    'description',
                    'status'
                ]
            );
        }
    }

    public function testInfo()
    {
        $apiProvider = ApiProviderFactory::new()->create();

        $emptyInfo = new ApiProviderInfoRequest();

        $emptyInfo->merge([
            'id' => 1232331
        ]);

        $this->assertNull($this->apiProviderRepository->info($emptyInfo));

        $issetInfo = new ApiProviderInfoRequest();
        $issetInfo->merge([
            'id' => $apiProvider->id
        ]);
        /** @var ApiProvider $result */
        $result = $this->apiProviderRepository->info($issetInfo);

        $this->checkEquals(
            $apiProvider,
            $result,
            [
                'user_id',
                'name',
                'url',
                'key',
                'type',
                'balance',
                'currency_code',
                'description',
                'status'
            ]
        );
    }

    public function testCreate()
    {
        $user = UserFactory::new()->create();
        Auth::shouldReceive('user')->andReturn($user);

        $insertData = [
            'user_id'       => $user->id,
            'name'          => Str::random(32),
            'url'           => Str::random(32),
            'key'           => Str::random(32),
            'type'          => Str::random(32),
            'balance'       => random_int(10, 100000),
            'currency_code' => Str::random(3),
            'description'   => Str::random(32),
            'status'        => true
        ];

        $create = new ApiProviderCreateRequest();
        $create->merge($insertData);

        /** @var ApiProvider $apiProvider */
        $apiProvider = $this->apiProviderRepository->create($create);

        $this->assertEquals($insertData["user_id"], $apiProvider->user_id);
        $this->assertEquals($insertData["name"], $apiProvider->name);
        $this->assertEquals($insertData["url"], $apiProvider->url);
        $this->assertEquals($insertData["key"], $apiProvider->key);
        $this->assertEquals($insertData["type"], $apiProvider->type);
        $this->assertEquals($insertData["balance"], $apiProvider->balance);
        $this->assertEquals($insertData["currency_code"], $apiProvider->currency_code);
        $this->assertEquals($insertData["description"], $apiProvider->description);
        $this->assertEquals($insertData["status"], $apiProvider->status);
    }

    public function testUpdate()
    {
        $user = UserFactory::new()->create();
        Auth::shouldReceive('user')->andReturn($user);

        $apiProvider = ApiProviderFactory::new()->create([
            'user_id' => $user->id
        ]);

        $info = new ApiProviderInfoRequest();
        $info->merge([
            'id' => $apiProvider->id
        ]);
        /** @var ApiProvider $result */
        $result = $this->apiProviderRepository->info($info);

        $this->checkEquals(
            $apiProvider,
            $result,
            [
                'user_id',
                'name',
                'url',
                'key',
                'type',
                'balance',
                'currency_code',
                'description',
                'status'
            ]
        );

        $updateData = [
            'id'            => $apiProvider->id,
            'user_id'       => $user->id,
            'name'          => Str::random(32),
            'url'           => Str::random(32),
            'key'           => Str::random(32),
            'type'          => Str::random(32),
            'balance'       => random_int(10, 100000),
            'currency_code' => Str::random(3),
            'description'   => Str::random(32),
            'status'        => true
        ];

        $update = new ApiProviderUpdateRequest();
        $update->merge($updateData);

        $this->assertTrue($this->apiProviderRepository->update($update));

        $info = new ApiProviderInfoRequest();
        $info->merge([
            'id' => $apiProvider->id
        ]);
        /** @var ApiProvider $result */
        $result = $this->apiProviderRepository->info($info);

        $this->assertEquals($updateData["user_id"], $result->user_id);
        $this->assertEquals($updateData["name"], $result->name);
        $this->assertEquals($updateData["url"], $result->url);
        $this->assertEquals($updateData["key"], $result->key);
        $this->assertEquals($updateData["type"], $result->type);
        $this->assertEquals($updateData["balance"], $result->balance);
        $this->assertEquals($updateData["currency_code"], $result->currency_code);
        $this->assertEquals($updateData["description"], $result->description);
        $this->assertEquals($updateData["status"], $result->status);

    }

    public function testDelete()
    {
        $user = UserFactory::new()->create();
        Auth::shouldReceive('user')->andReturn($user);

        $apiProvider = ApiProviderFactory::new()->create([
            'user_id' => $user->id
        ]);

        $info = new ApiProviderInfoRequest();
        $info->merge([
            'id' => $apiProvider->id
        ]);
        /** @var ApiProvider $result */
        $result = $this->apiProviderRepository->info($info);
        $this->checkEquals(
            $apiProvider,
            $result,
            [
                'user_id',
                'name',
                'url',
                'key',
                'type',
                'balance',
                'currency_code',
                'description',
                'status'
            ]
        );

        $delete = new ApiProviderDeleteRequest();
        $delete->merge([
            'id' => $apiProvider->id
        ]);

        $this->assertTrue($this->apiProviderRepository->delete($delete));

        $info = new ApiProviderInfoRequest();
        $info->merge([
            'id' => $apiProvider->id
        ]);
        /** @var ApiProvider $result */
        $this->assertNull($this->apiProviderRepository->info($info));
    }
}
