<?php

namespace Tests\Unit\Services\Permission;

use App\Http\Requests\Permission\PermissionCreateInterface;
use App\Http\Requests\Permission\PermissionDeleteInterface;
use App\Http\Requests\Permission\PermissionInfoInterface;
use App\Http\Requests\Permission\PermissionUpdateInterface;
use App\Interfaces\Repositories\PermissionInterface;
use App\Services\Permission\PermissionService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Permission;
use Tests\Factories\PermissionFactory;
use Tests\TestCase;

class PermissionServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Permission $permission;

    private PermissionService $permissionService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->permission = PermissionFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->permission);

        $repo = $this->createMock(PermissionInterface::class);
        $repo->method('list')->willReturn($collection);
        $repo->method('all')->willReturn($collection);
        $repo->method('getByIds')->willReturn($collection);
        $repo->method('info')->willReturn($this->permission);
        $repo->method('create')->willReturn(true);
        $repo->method('delete')->willReturn(true);
        $repo->method('update')->willReturn(true);

        $this->permissionService = new PermissionService($repo);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testList()
    {
        foreach ($this->permissionService->all() as $item) {
            $this->assertEquals($this->permission->name, $item->name);
            $this->assertEquals($this->permission->guard_name, $item->guard_name);
        }
    }

    public function testAll()
    {
        foreach ($this->permissionService->all() as $item) {
            $this->assertEquals($this->permission->name, $item->name);
            $this->assertEquals($this->permission->guard_name, $item->guard_name);
        }
    }

    public function testInfo()
    {
        $info = $this->createMock(PermissionInfoInterface::class);
        $info->method('getId')->willReturn($this->permission->id);

        $result = $this->permissionService->info($info);

        $this->assertEquals($this->permission->name, $result->name);
        $this->assertEquals($this->permission->guard_name, $result->guard_name);
    }

    public function testCreate()
    {
        $create = $this->createMock(PermissionCreateInterface::class);

        $this->assertTrue($this->permissionService->create($create));
    }

    public function testDelete()
    {
        $delete = $this->createMock(PermissionDeleteInterface::class);

        $this->assertTrue($this->permissionService->delete($delete));
    }

    public function testUpdate()
    {
        $update = $this->createMock(PermissionUpdateInterface::class);

        $this->assertTrue($this->permissionService->update($update));
    }
}
