<?php

namespace Tests\Unit\Services\Subscribe;

use App\Http\Requests\Subscribe\SubscribeAllInterface;
use App\Http\Requests\Subscribe\SubscribeCreateInterface;
use App\Http\Requests\Subscribe\SubscribeDeleteInterface;
use App\Http\Requests\Subscribe\SubscribeInfoInterface;
use App\Http\Requests\Subscribe\SubscribeUpdateInterface;
use App\Interfaces\Repositories\SubscribeInterface;
use App\Models\Subscribe;
use App\Services\Subscribe\SubscribeService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\SubscribeFactory;
use Tests\TestCase;

class SubscribeServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Subscribe $subscribe;
    private SubscribeService $subscribeService;

    public function setUp(): void
    {
        parent::setUp();

        $this->subscribe = SubscribeFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->subscribe);

        $repo = $this->createMock(SubscribeInterface::class);
        $repo->method('all')->willReturn($collection);
        $repo->method('info')->willReturn($this->subscribe);
        $repo->method('create')->willReturn($this->subscribe);
        $repo->method('update')->willReturn(true);
        $repo->method('delete')->willReturn(true);

        $this->subscribeService = new SubscribeService($repo);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $all = $this->createMock(SubscribeAllInterface::class);

        /** @var Subscribe $item */
        foreach ($this->subscribeService->all($all) as $item) {
            $this->assertEquals($this->subscribe->first_name, $item->first_name);
            $this->assertEquals($this->subscribe->last_name, $item->last_name);
            $this->assertEquals($this->subscribe->email, $item->email);
            $this->assertEquals($this->subscribe->ip, $item->ip);
            $this->assertEquals($this->subscribe->country_code, $item->country_code);
            $this->assertEquals($this->subscribe->id, $item->id);
        }
    }

    public function testInfo()
    {
        $info = $this->createMock(SubscribeInfoInterface::class);

        /** @var Subscribe $result */
        $result = $this->subscribeService->info($info);

        $this->assertEquals($this->subscribe->first_name, $result->first_name);
        $this->assertEquals($this->subscribe->last_name, $result->last_name);
        $this->assertEquals($this->subscribe->email, $result->email);
        $this->assertEquals($this->subscribe->ip, $result->ip);
        $this->assertEquals($this->subscribe->country_code, $result->country_code);
        $this->assertEquals($this->subscribe->id, $result->id);
    }

    public function testCreate()
    {
        $create = $this->createMock(SubscribeCreateInterface::class);

        /** @var Subscribe $result */
        $result = $this->subscribeService->create($create);

        $this->assertEquals($this->subscribe->first_name, $result->first_name);
        $this->assertEquals($this->subscribe->last_name, $result->last_name);
        $this->assertEquals($this->subscribe->email, $result->email);
        $this->assertEquals($this->subscribe->ip, $result->ip);
        $this->assertEquals($this->subscribe->country_code, $result->country_code);
        $this->assertEquals($this->subscribe->id, $result->id);
    }

    public function testUpdate()
    {
        $update = $this->createMock(SubscribeUpdateInterface::class);

        $this->assertTrue($this->subscribeService->update($update));
    }

    public function testDelete()
    {
        $delete = $this->createMock(SubscribeDeleteInterface::class);

        $this->assertTrue($this->subscribeService->delete($delete));
    }
}
