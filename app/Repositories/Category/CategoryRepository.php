<?php

namespace App\Repositories\Category;

use App\Helpers\ArrayHelper;
use App\Http\Requests\Category\CategoryAllInterface;
use App\Http\Requests\Category\CategoryCreateInterface;
use App\Http\Requests\Category\CategoryDeleteInterface;
use App\Http\Requests\Category\CategoryInfoInterface;
use App\Http\Requests\Category\CategoryUpdateInterface;
use App\Interfaces\Repositories\CategoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CategoryRepository implements CategoryInterface
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all(CategoryAllInterface $all): Collection
    {
        return $this
            ->category
            ->newQuery()
            ->when((Auth::user() && !Auth::user()->isAdmin()), function ($query, $user) {
                return $query->where('status', true);
            })
            ->orderBy('id', 'desc')
            ->get();
    }

    public function info(CategoryInfoInterface $info): Model
    {
        return $this
            ->category
            ->newQuery()
            ->where('id', $info->getId())
            ->when((Auth::user() && !Auth::user()->isAdmin()), function ($query, $user) use ($info) {
                return $query->where('user_id', $info->getUserId());
            })
            ->when((Auth::user() && !Auth::user()->isAdmin()), function ($query, $user) {
                return $query->where('status', true);
            })
            ->first();
    }

    public function add(CategoryCreateInterface $create): Model
    {
        /** @var Category $category */
        $category = new $this->category();
        $category->fill([
            'user_id'       => $create->getUserId(),
            'name'          => $create->getName(),
            'description'   => $create->getDescription(),
            'image_url'     => $create->getImageUrl(),
            'sort'          => $create->getSort(),
            'status'        => $create->getStatus(),
        ]);
        $category->save();

        return $category;
    }

    public function delete(CategoryDeleteInterface $delete): bool
    {
        return $this
            ->category
            ->newQuery()
            ->when($delete->getId(), function ($query, $id) {
                return $query->where('id', $id);
            })
            ->when($delete->getIds(), function ($query, $ids) {
                return $query->whereIn('id', $ids);
            })
            ->when(!is_null($delete->getStatus()), function ($query, $status) use ($delete) {
                return $query->where('status', $delete->getStatus());
            })
            ->where('user_id', $delete->getUserId())
            ->delete();
    }

    public function update(CategoryUpdateInterface $update): bool
    {
        return $this
            ->category
            ->newQuery()
            ->where('id', $update->getId())
            ->where('user_id', $update->getUserId())
            ->update(ArrayHelper::filterEmpty([
                'name'          => $update->getName(),
                'description'   => $update->getDescription(),
                'image_url'     => $update->getImageUrl(),
                'sort'          => $update->getSort(),
                'status'        => $update->getStatus(),
            ]));
    }
}
