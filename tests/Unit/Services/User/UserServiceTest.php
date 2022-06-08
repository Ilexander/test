<?php

namespace Tests\Unit\Services\User;

use App\Http\Requests\Role\RoleInfoRequest;
use App\Http\Requests\User\UserAllRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserInfoRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Interfaces\Repositories\UserInterface;
use App\Models\User;
use App\Services\Payment\PaymentFacade;
use App\Services\User\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\PaymentFactory;
use Tests\Factories\ServiceFactory;
use Tests\Factories\UserFactory;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use DatabaseMigrations;

    private User $user;
    private UserService $userService;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();

        $collection = new Collection();
        $collection->add($this->user);

        $repo = $this->createMock(UserInterface::class);
        $repo->method('list')->willReturn($collection);
        $repo->method('all')->willReturn($collection);
        $repo->method('info')->willReturn($this->user);
        $repo->method('create')->willReturn($this->user);
        $repo->method('delete')->willReturn(true);
        $repo->method('update')->willReturn(true);

        $this->userService = new UserService($repo);


        PaymentFacade::shouldReceive('info')
            ->andReturn(PaymentFactory::new()->create());

//        $this->createMock(PaymentFacade::class)
//            ->method('info')->willReturn(PaymentFactory::new()->create());
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testInfo()
    {
        $info = new UserInfoRequest();
        /** @var User $userInfo */
        $userInfo = $this->userService->info($info);

        $this->checkObjectEquals($this->user, $userInfo);
    }

    public function testList()
    {
        /** @var User $item */
        foreach ($this->userService->list() as $item) {
            $this->checkObjectEquals($this->user, $item);
        }
    }

    public function testAll()
    {
        $all = new UserAllRequest();

        /** @var User $item */
        foreach ($this->userService->all($all) as $item) {
            $this->checkObjectEquals($this->user, $item);
        }
    }

    public function testCreate()
    {
        $serviceFirst = ServiceFactory::new()->create();
        $serviceSecond = ServiceFactory::new()->create();

        $create = new UserCreateRequest();
        $create->merge([
            "email"     => "someMail",
            "first_name" => "russik",
            "last_name" => "test",
            "password" => "somePass",
            "timezone" => "Africa/Abidjan",
            "role_id" => 1,
            "payments" => [
                1
            ],
            "services" => [
                [
                    "service" => $serviceFirst->id,
                    "priceValue" => 2.5
                ],
                [
                    "service" => $serviceSecond->id,
                    "priceValue" => 1.7
                ],
            ]
        ]);

        $info = new RoleInfoRequest();
        $info->merge([
            "id" => 1
        ]);

        /** @var User $user */
        $user = $this->userService->create($create, $info);

        $this->checkObjectEquals($this->user, $user);
    }

    public function testUpdate()
    {
        $serviceFirst = ServiceFactory::new()->create();
        $serviceSecond = ServiceFactory::new()->create();

        $update = new UserUpdateRequest();
        $update->merge([
            "id" => 1,
            "email"     => "someMail",
            "first_name" => "russik",
            "last_name" => "test",
            "password" => "somePass",
            "timezone" => "Africa/Abidjan",
            "role_id" => 1,
            "payments" => [
                2
            ],
            "services" => [
                [
                    "service" => $serviceFirst->id,
                    "priceValue" => 2.5
                ],
                [
                    "service" => $serviceSecond->id,
                    "priceValue" => 1.7
                ],
            ]
        ]);

        $info = new RoleInfoRequest();
        $info->merge([
            "id" => 1
        ]);
        $this->userService->update($update, $info);

        $this->assertTrue($this->userService->update($update, $info));
    }

    public function testDelete()
    {
        $delete = new UserDeleteRequest();
        $delete->merge([
            "id" => 1
        ]);

        $this->assertTrue($this->userService->delete($delete));
    }

    private function checkObjectEquals(User $expected, User $actual)
    {
        $this->assertEquals($expected->id, $actual->id);
        $this->assertEquals($expected->email, $actual->email);
        $this->assertEquals($expected->password, $actual->password);
        $this->assertEquals($expected->role_id, $actual->role_id);
        $this->assertEquals($expected->login_type, $actual->login_type);
        $this->assertEquals($expected->first_name, $actual->first_name);
        $this->assertEquals($expected->last_name, $actual->last_name);
        $this->assertEquals($expected->timezone, $actual->timezone);
        $this->assertEquals($expected->more_information, $actual->more_information);
        $this->assertEquals($expected->desc, $actual->desc);
        $this->assertEquals($expected->balance, $actual->balance);
        $this->assertEquals($expected->custom_rate, $actual->custom_rate);
        $this->assertEquals($expected->api_key, $actual->api_key);
        $this->assertEquals($expected->spent, $actual->spent);
        $this->assertEquals($expected->activation_key, $actual->activation_key);
        $this->assertEquals($expected->status, $actual->status);
    }
}
