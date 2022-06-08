<?php

namespace Tests\Unit\Services\Service;

use App\Http\Requests\Service\ServiceAllInterface;
use App\Http\Requests\Service\ServiceCreateInterface;
use App\Http\Requests\Service\ServiceDeleteInterface;
use App\Http\Requests\Service\ServiceInfoInterface;
use App\Http\Requests\Service\ServiceUpdateInterface;
use App\Interfaces\Repositories\ServiceInterface;
use App\Models\Service;
use App\Services\Service\ServiceService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\Factories\ServiceFactory;

class ServiceServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Service $service;
    private ServiceService $serviceService;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = ServiceFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->service);

        $repo = $this->createMock(ServiceInterface::class);
        $repo->method('all')->willReturn($collection);
        $repo->method('info')->willReturn($this->service);
        $repo->method('create')->willReturn($this->service);
        $repo->method('update')->willReturn(true);
        $repo->method('delete')->willReturn(true);

        $this->serviceService = new ServiceService($repo);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $all = $this->createMock(ServiceAllInterface::class);

        /** @var Service $item */
        foreach ($this->serviceService->all($all) as $item) {
            $this->assertEquals($this->service->user_id, $item->user_id);
            $this->assertEquals($this->service->category_id, $item->category_id);
            $this->assertEquals($this->service->name, $item->name);
            $this->assertEquals($this->service->desc, $item->desc);
            $this->assertEquals($this->service->price, $item->price);
            $this->assertEquals($this->service->original_price, $item->original_price);
            $this->assertEquals($this->service->min, $item->min);
            $this->assertEquals($this->service->max, $item->max);
            $this->assertEquals($this->service->add_type, $item->add_type);
            $this->assertEquals($this->service->type, $item->type);
            $this->assertEquals($this->service->api_service_id, $item->api_service_id);
            $this->assertEquals($this->service->api_provider_id, $item->api_provider_id);
            $this->assertEquals($this->service->dripfeed, $item->dripfeed);
            $this->assertEquals($this->service->status, $item->status);
            $this->assertEquals($this->service->id, $item->id);
        }
    }

    public function testInfo()
    {
        $info = $this->createMock(ServiceInfoInterface::class);

        /** @var Service $result */
        $result = $this->serviceService->info($info);

        $this->assertEquals($this->service->user_id, $result->user_id);
        $this->assertEquals($this->service->category_id, $result->category_id);
        $this->assertEquals($this->service->name, $result->name);
        $this->assertEquals($this->service->desc, $result->desc);
        $this->assertEquals($this->service->price, $result->price);
        $this->assertEquals($this->service->original_price, $result->original_price);
        $this->assertEquals($this->service->min, $result->min);
        $this->assertEquals($this->service->max, $result->max);
        $this->assertEquals($this->service->add_type, $result->add_type);
        $this->assertEquals($this->service->type, $result->type);
        $this->assertEquals($this->service->api_service_id, $result->api_service_id);
        $this->assertEquals($this->service->api_provider_id, $result->api_provider_id);
        $this->assertEquals($this->service->dripfeed, $result->dripfeed);
        $this->assertEquals($this->service->status, $result->status);
        $this->assertEquals($this->service->id, $result->id);
    }

    public function testCreate()
    {
        $create = $this->createMock(ServiceCreateInterface::class);

        /** @var Service $result */
        $result = $this->serviceService->create($create);

        $this->assertEquals($this->service->user_id, $result->user_id);
        $this->assertEquals($this->service->category_id, $result->category_id);
        $this->assertEquals($this->service->name, $result->name);
        $this->assertEquals($this->service->desc, $result->desc);
        $this->assertEquals($this->service->price, $result->price);
        $this->assertEquals($this->service->original_price, $result->original_price);
        $this->assertEquals($this->service->min, $result->min);
        $this->assertEquals($this->service->max, $result->max);
        $this->assertEquals($this->service->add_type, $result->add_type);
        $this->assertEquals($this->service->type, $result->type);
        $this->assertEquals($this->service->api_service_id, $result->api_service_id);
        $this->assertEquals($this->service->api_provider_id, $result->api_provider_id);
        $this->assertEquals($this->service->dripfeed, $result->dripfeed);
        $this->assertEquals($this->service->status, $result->status);
        $this->assertEquals($this->service->id, $result->id);
    }

    public function testUpdate()
    {
        $update = $this->createMock(ServiceUpdateInterface::class);

        $this->assertTrue($this->serviceService->update($update));
    }


    public function testDelete()
    {
        $delete = $this->createMock(ServiceDeleteInterface::class);

        $this->assertTrue($this->serviceService->delete($delete));
    }
}
