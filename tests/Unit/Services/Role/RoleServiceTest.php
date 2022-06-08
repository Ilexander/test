<?php

namespace Tests\Unit\Services\Role;

use App\Http\Requests\Role\RoleAllInterface;
use App\Http\Requests\Role\RoleCreateInterface;
use App\Http\Requests\Role\RoleDeleteInterface;
use App\Http\Requests\Role\RoleUpdateInterface;
use App\Interfaces\Repositories\PermissionInterface;
use App\Interfaces\Repositories\RoleInterface;
use App\Repositories\Role\RolePermissionRepository;
use App\Services\Role\RoleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Spatie\Permission\Models\Role;
use Tests\Factories\PermissionFactory;
use Tests\Factories\RoleFactory;
use Tests\TestCase;

class RoleServiceTest extends TestCase
{
    use DatabaseMigrations;

    private Role $role;
    private RoleService $roleService;
    private Collection $permissionCollection;

    protected function setUp(): void
    {
        parent::setUp();

        $this->role = RoleFactory::new()->create();
        $collection = new Collection();
        $collection->add($this->role);

        $roleRepo = $this->createMock(RoleInterface::class);
        $roleRepo->method('all')->willReturn($collection);
        $roleRepo->method('info')->willReturn($this->role);
        $roleRepo->method('create')->willReturn($this->role);
        $roleRepo->method('update')->willReturn(true);
        $roleRepo->method('delete')->willReturn(true);

        $permission = PermissionFactory::new()->create();
        $this->permissionCollection = new Collection();
        $this->permissionCollection->add($permission);

        $permissionRepo = $this->createMock(PermissionInterface::class);
        $permissionRepo->method('list')->willReturn($this->permissionCollection);
        $permissionRepo->method('all')->willReturn($this->permissionCollection);
        $permissionRepo->method('getByIds')->willReturn($this->permissionCollection);
        $permissionRepo->method('info')->willReturn($permission);
        $permissionRepo->method('create')->willReturn(true);
        $permissionRepo->method('delete')->willReturn(true);
        $permissionRepo->method('update')->willReturn(true);

        $rolePermissionRepo = $this->createMock(RolePermissionRepository::class);
        $rolePermissionRepo->method('getRolePermissions')->willReturn($this->permissionCollection);
        $rolePermissionRepo->method('getPermissionRoles')->willReturn($collection);


        $this->roleService = new RoleService(
            $roleRepo,
            $permissionRepo,
            $rolePermissionRepo
        );
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testAll()
    {
        $all = $this->createMock(RoleAllInterface::class);

        foreach ($this->roleService->all($all) as $item) {
            $this->assertEquals($this->role->guard_name, $item->guard_name);
            $this->assertEquals($this->role->name, $item->name);
            $this->assertEquals($this->role->id, $item->id);
        }
    }

    public function testCreate()
    {
        $create = $this->createMock(RoleCreateInterface::class);
        $create->method('getPermission')->willReturn($this->permissionCollection->toArray());
        $result = $this->roleService->create($create);

        $this->assertEquals($this->role->guard_name, $result->guard_name);
        $this->assertEquals($this->role->name, $result->name);
        $this->assertEquals($this->role->id, $result->id);
    }

    public function testDelete()
    {
        $delete = $this->createMock(RoleDeleteInterface::class);
        $this->assertTrue($this->roleService->delete($delete));
    }

    public function testUpdate()
    {
        $update = $this->createMock(RoleUpdateInterface::class);
        $update->method('getPermission')->willReturn($this->permissionCollection->toArray());
        $this->assertTrue($this->roleService->update($update));
    }
}
