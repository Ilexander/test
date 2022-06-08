<?php

namespace Tests\Unit\Services\ApiProvider;

use App\Http\Requests\ApiProvider\ApiProviderAllInterface;
use App\Http\Requests\ApiProvider\ApiProviderCreateRequest;
use App\Http\Requests\ApiProvider\ApiProviderDeleteRequest;
use App\Http\Requests\ApiProvider\ApiProviderInfoRequest;
use App\Http\Requests\ApiProvider\ApiProviderUpdateRequest;
use App\Interfaces\Repositories\ApiProviderInterface;
use App\Models\ApiProvider;
use App\Services\ApiProvider\ApiProviderApiService;
use App\Services\ApiProvider\ApiProviderService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\ApiProviderFactory;
use Tests\TestCase;

class ApiProviderServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected ApiProviderService $apiProviderService;
    protected ApiProvider $apiProvider;

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiProvider = ApiProviderFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->apiProvider);

        $repo = $this->createMock(ApiProviderInterface::class);
        $repo->method('list')->willReturn($collection);
        $repo->method('info')->willReturn($this->apiProvider);
        $repo->method('create')->willReturn($this->apiProvider);
        $repo->method('update')->willReturn(true);
        $repo->method('delete')->willReturn(true);

        $apiService = $this->createMock(ApiProviderApiService::class);
        $apiService
            ->method('getApiServicesToProvider')
            ->willReturn('{"russik" : "here"}');

        $this->apiProviderService = new ApiProviderService($repo, $apiService);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testList()
    {
        /** @var ApiProviderAllInterface $all */
        $all = $this->createMock(ApiProviderAllInterface::class);
        $list = $this->apiProviderService->list($all);

        /** @var ApiProvider $item */
        foreach ($list as $item) {
            $this->assertEquals($this->apiProvider->user_id, $item->user_id);
            $this->assertEquals($this->apiProvider->name, $item->name);
            $this->assertEquals($this->apiProvider->url, $item->url);
            $this->assertEquals($this->apiProvider->key, $item->key);
            $this->assertEquals($this->apiProvider->type, $item->type);
            $this->assertEquals($this->apiProvider->balance, $item->balance);
            $this->assertEquals($this->apiProvider->currency_code, $item->currency_code);
            $this->assertEquals($this->apiProvider->description, $item->description);
            $this->assertEquals($this->apiProvider->status, $item->status);
        }
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testInfo(): void
    {
        /** @var ApiProviderInfoRequest $info */
        $info = $this->createMock(ApiProviderInfoRequest::class);
        /** @var ApiProvider $apiProvider */
        $apiProvider = $this->apiProviderService->info($info);

        $this->assertEquals($this->apiProvider->user_id, $apiProvider->user_id);
        $this->assertEquals($this->apiProvider->name, $apiProvider->name);
        $this->assertEquals($this->apiProvider->url, $apiProvider->url);
        $this->assertEquals($this->apiProvider->key, $apiProvider->key);
        $this->assertEquals($this->apiProvider->type, $apiProvider->type);
        $this->assertEquals($this->apiProvider->balance, $apiProvider->balance);
        $this->assertEquals($this->apiProvider->currency_code, $apiProvider->currency_code);
        $this->assertEquals($this->apiProvider->description, $apiProvider->description);
        $this->assertEquals($this->apiProvider->status, $apiProvider->status);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreate(): void
    {
        /** @var ApiProviderCreateRequest $create */
        $create = $this->createMock(ApiProviderCreateRequest::class);
        /** @var ApiProvider $apiProvider */
        $apiProvider = $this->apiProviderService->create($create);

        $this->assertEquals($this->apiProvider->user_id, $apiProvider->user_id);
        $this->assertEquals($this->apiProvider->name, $apiProvider->name);
        $this->assertEquals($this->apiProvider->url, $apiProvider->url);
        $this->assertEquals($this->apiProvider->key, $apiProvider->key);
        $this->assertEquals($this->apiProvider->type, $apiProvider->type);
        $this->assertEquals($this->apiProvider->balance, $apiProvider->balance);
        $this->assertEquals($this->apiProvider->currency_code, $apiProvider->currency_code);
        $this->assertEquals($this->apiProvider->description, $apiProvider->description);
        $this->assertEquals($this->apiProvider->status, $apiProvider->status);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUpdate(): void
    {
        /** @var ApiProviderUpdateRequest $update */
        $update = $this->createMock(ApiProviderUpdateRequest::class);

        $result = $this->apiProviderService->update($update);

        $this->assertTrue($result);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDelete(): void
    {
        /** @var ApiProviderDeleteRequest $delete */
        $delete = $this->createMock(ApiProviderDeleteRequest::class);

        $result = $this->apiProviderService->delete($delete);

        $this->assertTrue($result);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testServices(): void
    {
        /** @var ApiProviderInfoRequest $info */
        $info = $this->createMock(ApiProviderInfoRequest::class);
        $result = $this->apiProviderService->services($info);

        $this->assertEquals('here', $result['russik']);
    }
}
