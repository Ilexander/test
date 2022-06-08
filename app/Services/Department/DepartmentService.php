<?php

namespace App\Services\Department;

use App\Http\Requests\Department\AddDepartmentInterface;
use App\Http\Requests\Department\DeleteDepartmentInterface;
use App\Http\Requests\Department\EditDepartmentInterface;
use App\Http\Requests\Department\MemberDepartmentInterface;
use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class DepartmentService
{
    public function list(): Collection
    {
        return Department::query()->with('users')->get();
    }

    public function add(AddDepartmentInterface $add)
    {
        $department = new Department();
        $department->fill([
            'name' => $add->getName()
        ]);
        $department->save();

        if ($add->getMembers()) {
            $this->addMembers($department->id, $add->getMembers());
        }
    }

    public function addMembers(int $departmentId, array $members)
    {
        $insertArray = [];

        foreach (array_unique($members) as $member) {
            $insertArray[] = [
                'user_id'       => $member,
                'department_id' => $departmentId
            ];
        }

        DepartmentUser::query()->insert($insertArray);
    }

    public function editMembers(int $departmentId, array $members)
    {
        $this->removeMembers($departmentId);

        $insertArray = [];

        foreach (array_unique($members) as $member) {
            $insertArray[] = [
                'user_id'       => $member,
                'department_id' => $departmentId
            ];
        }

        DepartmentUser::query()->insert($insertArray);
    }

    public function removeMembers(int $departmentId)
    {
        DepartmentUser::query()->where('department_id', $departmentId)->delete();
    }

    public function delete(DeleteDepartmentInterface $delete)
    {
        Department::query()->where('id', $delete->getId())->delete();
    }

    public function edit(EditDepartmentInterface $edit)
    {
        Department::query()->where('id', $edit->getId())->update([
            'name' => $edit->getName()
        ]);

        if ($edit->getMembers()) {
            $this->editMembers($edit->getId(), $edit->getMembers());
        } else {
            $this->removeMembers($edit->getId());
        }
    }

    public function members(MemberDepartmentInterface $department)
    {
        return Department::query()
            ->with('users.user')
            ->find($department->getDepartmentId())
            ->users;
    }
}