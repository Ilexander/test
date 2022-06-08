<?php

namespace Tests\Unit\Services\Department;

use App\Http\Requests\Department\AddDepartmentInterface;
use App\Http\Requests\Department\DeleteDepartmentInterface;
use App\Http\Requests\Department\EditDepartmentInterface;
use App\Http\Requests\Department\MemberDepartmentInterface;
use App\Services\Department\DepartmentService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Factories\DepartmentFactory;
use Tests\Factories\UserFactory;
use Tests\TestCase;

class DepartmentServiceTest extends TestCase
{
    use DatabaseMigrations;

    private DepartmentService $departmentService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->departmentService = new DepartmentService();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testList()
    {
        $collection = new Collection();
        $collection->add(DepartmentFactory::new()->create());
        $collection->add(DepartmentFactory::new()->create());

        $collection = $collection->toArray();
        $result = $this->departmentService->list()->toArray();

        for ($i = 0; $i < count($collection); $i++) {
            $this->assertEquals($collection[$i]['id'], $result[$i]['id']);
            $this->assertEquals($collection[$i]['name'], $result[$i]['name']);
        }
    }

    public function testAdd()
    {
        $userCollection = new Collection();
        $userCollection->add(UserFactory::new()->create());
        $userCollection->add(UserFactory::new()->create());
        $userCollection = $userCollection->toArray();

        $add = $this->createMock(AddDepartmentInterface::class);
        $add->method('getName')->willReturn('russik test');
        $add->method('getMembers')->willReturn(array_column($userCollection,'id'));

        $this->departmentService->add($add);

        $result = $this->departmentService->list()->toArray();

        foreach ($userCollection as $key => $user) {
            $this->assertEquals($user['id'], $result[0]['users'][$key]['user_id']);
        }

        $this->assertEquals('russik test', $result[0]['name']);
    }

    public function testAddMembers()
    {
        $department = DepartmentFactory::new()->create();

        $userCollection = new Collection();
        $userCollection->add(UserFactory::new()->create());
        $userCollection->add(UserFactory::new()->create());
        $userCollection = $userCollection->toArray();

        $result = $this->departmentService->list()->toArray();

        $this->assertEmpty($result[0]['users']);

        $this->departmentService->addMembers($department->id, array_column($userCollection,'id'));

        $result = $this->departmentService->list()->toArray();

        foreach ($userCollection as $key => $user) {
            $this->assertEquals($user['id'], $result[0]['users'][$key]['user_id']);
        }
    }

    public function testEditMembers()
    {
        $department = DepartmentFactory::new()->create();

        $userCollection = new Collection();
        $userCollection->add(UserFactory::new()->create());
        $userCollection->add(UserFactory::new()->create());
        $userCollection = $userCollection->toArray();

        $result = $this->departmentService->list()->toArray();
        $this->assertEmpty($result[0]['users']);

        $this->departmentService->addMembers($department->id, array_column($userCollection,'id'));

        $result = $this->departmentService->list()->toArray();

        foreach ($userCollection as $key => $user) {
            $this->assertEquals($user['id'], $result[0]['users'][$key]['user_id']);
        }

        $newUserCollection = new Collection();
        $newUserCollection->add(UserFactory::new()->create());
        $newUserCollection->add(UserFactory::new()->create());
        $newUserCollection = $newUserCollection->toArray();

        $this->departmentService->editMembers($department->id, array_column($newUserCollection,'id'));
        $result = $this->departmentService->list()->toArray();

        foreach ($newUserCollection as $key => $user) {
            $this->assertEquals($user['id'], $result[0]['users'][$key]['user_id']);
        }
    }

    public function testRemoveMembers()
    {
        $department = DepartmentFactory::new()->create();

        $userCollection = new Collection();
        $userCollection->add(UserFactory::new()->create());
        $userCollection->add(UserFactory::new()->create());
        $userCollection = $userCollection->toArray();

        $this->departmentService->addMembers($department->id, array_column($userCollection,'id'));

        $result = $this->departmentService->list()->toArray();

        foreach ($userCollection as $key => $user) {
            $this->assertEquals($user['id'], $result[0]['users'][$key]['user_id']);
        }

        $this->departmentService->removeMembers($department->id);

        $result = $this->departmentService->list()->toArray();
        $this->assertEmpty($result[0]['users']);
    }

    public function testDelete()
    {
        $department = DepartmentFactory::new()->create();
        $result = $this->departmentService->list()->toArray();

        $this->assertNotEmpty($result);

        $delete = $this->createMock(DeleteDepartmentInterface::class);
        $delete->method('getId')->willReturn($department->id);

        $this->departmentService->delete($delete);

        $result = $this->departmentService->list()->toArray();

        $this->assertEmpty($result);
    }

    public function testEdit()
    {
        $department = DepartmentFactory::new()->create();

        $oldUserCollection = new Collection();
        $oldUserCollection->add(UserFactory::new()->create());
        $oldUserCollection->add(UserFactory::new()->create());
        $oldUserCollection = $oldUserCollection->toArray();

        $this->departmentService->addMembers($department->id, array_column($oldUserCollection,'id'));

        $result = $this->departmentService->list()->toArray();

        foreach ($oldUserCollection as $key => $user) {
            $this->assertEquals($user['id'], $result[0]['users'][$key]['user_id']);
        }

        $this->assertEquals($department->name, $result[0]['name']);

        $newUserCollection = new Collection();
        $newUserCollection->add(UserFactory::new()->create());
        $newUserCollection->add(UserFactory::new()->create());
        $newUserCollection = $newUserCollection->toArray();

        $update = $this->createMock(EditDepartmentInterface::class);
        $update->method('getId')->willReturn($department->id);
        $update->method('getName')->willReturn('new name');
        $update->method('getMembers')->willReturn(array_column($newUserCollection,'id'));

        $this->departmentService->edit($update);

        $result = $this->departmentService->list()->toArray();

        $this->assertEquals($update->getName(), $result[0]['name']);

        foreach ($newUserCollection as $key => $user) {
            $this->assertEquals($user['id'], $result[0]['users'][$key]['user_id']);
        }
    }

    public function testMembers()
    {
        $department = DepartmentFactory::new()->create();

        $userCollection = new Collection();
        $userCollection->add(UserFactory::new()->create());
        $userCollection->add(UserFactory::new()->create());
        $userCollection = $userCollection->toArray();

        $this->departmentService->addMembers($department->id, array_column($userCollection,'id'));

        $memberDepartment = $this->createMock(MemberDepartmentInterface::class);
        $memberDepartment->method('getDepartmentId')->willReturn($department->id);

        $result = $this->departmentService->members($memberDepartment)->toArray();

        foreach ($userCollection as $key => $item) {
            $this->assertEquals($item['id'], $result[$key]['user']['id']);
            $this->assertEquals($item['email'], $result[$key]['user']['email']);
            //$this->assertEquals($item['email_verified_at'], $result[$key]['user']['email_verified_at']);
            $this->assertEquals($item['role_id'], $result[$key]['user']['role_id']);
            $this->assertEquals($item['login_type'], $result[$key]['user']['login_type']);
            $this->assertEquals($item['first_name'], $result[$key]['user']['first_name']);
            $this->assertEquals($item['last_name'], $result[$key]['user']['last_name']);
            $this->assertEquals($item['timezone'], $result[$key]['user']['timezone']);
            $this->assertEquals($item['more_information'], $result[$key]['user']['more_information']);
            $this->assertEquals($item['desc'], $result[$key]['user']['desc']);
            $this->assertEquals(round($item['balance']), round($result[$key]['user']['balance']));
            $this->assertEquals($item['custom_rate'], $result[$key]['user']['custom_rate']);
            $this->assertEquals($item['api_key'], $result[$key]['user']['api_key']);
            $this->assertEquals($item['spent'], $result[$key]['user']['spent']);
            $this->assertEquals($item['activation_key'], $result[$key]['user']['activation_key']);
            $this->assertEquals($item['status'], $result[$key]['user']['status']);
        }
    }
}
