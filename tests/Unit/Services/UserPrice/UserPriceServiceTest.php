<?php

namespace Tests\Unit\Services\UserPrice;

use App\DTO\User\UserPersonalPriceCollectionDTO;
use App\DTO\User\UserPersonalPriceDTO;
use App\Http\Requests\UserPrice\UserPriceAllRequest;
use App\Http\Requests\UserPrice\UserPriceDeleteRequest;
use App\Http\Requests\UserPrice\UserPriceInfoRequest;
use App\Http\Requests\UserPrice\UserPriceUpdateRequest;
use App\Interfaces\Repositories\UserPriceInterface;
use App\Models\UserPrice;
use App\Services\UserPrice\UserPriceService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\ServiceFactory;
use Tests\Factories\UserFactory;
use Tests\Factories\UserPriceFactory;
use Tests\TestCase;

class UserPriceServiceTest extends TestCase
{
    use DatabaseMigrations;

    private UserPrice $userPrice;
    private UserPriceService $userPriceService;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->userPrice = UserPriceFactory::new()->create();

        $collection = new Collection();
        $collection->add($this->userPrice);

        $repo = $this->createMock(UserPriceInterface::class);
        $repo->method('all')->willReturn($collection);
        $repo->method('info')->willReturn($this->userPrice);
//        $repo->method('create')->willReturn();
        $repo->method('update')->willReturn(true);
        $repo->method('delete')->willReturn(true);
        $repo->method('deletePricesByUserId')->willReturn(true);


        $this->userPriceService = new UserPriceService($repo);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $all = new UserPriceAllRequest();

        /** @var UserPrice $item */
        foreach ($this->userPriceService->all($all) as $item) {
            $this->assertEquals($this->userPrice->id, $item->id);
            $this->assertEquals($this->userPrice->user_id, $item->user_id);
            $this->assertEquals($this->userPrice->service_id, $item->service_id);
            $this->assertEquals($this->userPrice->service_price, $item->service_price);
        }
    }

    public function testInfo()
    {
        $info = new UserPriceInfoRequest();

        /** @var UserPrice $create */
        $create = $this->userPriceService->info($info);

        $this->assertEquals($this->userPrice->id, $create->id);
        $this->assertEquals($this->userPrice->user_id, $create->user_id);
        $this->assertEquals($this->userPrice->service_id, $create->service_id);
        $this->assertEquals($this->userPrice->service_price, $create->service_price);
    }

    public function testCreate()
    {
        $userItem = new UserPersonalPriceDTO(
            UserFactory::new()->create()->id,
            ServiceFactory::new()->create()->id,
        17.5
        );

        $create = new UserPersonalPriceCollectionDTO();
        $create->setItem($userItem);

        $this->userPriceService->create($create);
    }

    public function testDelete()
    {
        $delete = new UserPriceDeleteRequest();

        $this->assertTrue($this->userPriceService->delete($delete));
    }

    public function testUpdate()
    {
        $update = new UserPriceUpdateRequest();

        $this->assertTrue($this->userPriceService->update($update));
    }

    public function testDeletePricesByUserId()
    {
        $this->assertTrue($this->userPriceService->deletePricesByUserId(UserFactory::new()->create()->id));
    }
}
