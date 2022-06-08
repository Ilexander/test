<?php

namespace App\Services\Category;

use App\Http\Requests\Category\CategoryAllInterface;
use App\Http\Requests\Category\CategoryCreateInterface;
use App\Http\Requests\Category\CategoryDeleteInterface;
use App\Http\Requests\Category\CategoryInfoInterface;
use App\Http\Requests\Category\CategoryUpdateInterface;
use App\Interfaces\Repositories\CategoryInterface;
use App\Models\Category;
use App\Services\Image\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CategoryService
 * @package App\Services\Category
 */
class CategoryService
{
    private CategoryInterface $repo;
    private ImageService $imageService;

    /**
     * CategoryService constructor.
     * @param CategoryInterface $repo
     * @param ImageService $imageService
     */
    public function __construct(CategoryInterface $repo, ImageService $imageService)
    {
        $this->repo = $repo;
        $this->imageService = $imageService;
    }

    /**
     * @param CategoryAllInterface $all
     * @return Collection
     */
    public function list(CategoryAllInterface $all): Collection
    {
        return $this->repo->all($all);
    }

    /**
     * @param CategoryInfoInterface $info
     * @return Model
     */
    public function info(CategoryInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param CategoryCreateInterface $create
     * @return Model
     */
    public function create(CategoryCreateInterface $create): Model
    {
        if ($create->getImage()) {
            $create->setImageUrl($this->imageService->saveImage($create->getImage()));
        }

        return $this->repo->add($create);
    }

    /**
     * @param CategoryUpdateInterface $update
     * @return bool
     */
    public function update(CategoryUpdateInterface $update): bool
    {
        if ($update->getImage()) {
            $update->setImageUrl($this->imageService->saveImage($update->getImage()));
        }

        return $this->repo->update($update);
    }

    /**
     * @param CategoryDeleteInterface $delete
     * @return bool
     */
    public function delete(CategoryDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }

    public function formResponseCollection(Collection $categories): Collection
    {
        return $categories->map(function ($item, $key) {
            return $this->fromResponseItem($item);
        });
    }

    public function fromResponseItem(Category $category): Category
    {
        $categoryNew = new Category();
        $categoryNew->id = $category->id;
        $categoryNew->user_id = $category->user_id;
        $categoryNew->name = $category->name;
        $categoryNew->description = $category->description;
        $categoryNew->image_url = $category->image_url;
        $categoryNew->sort = $category->sort;
        $categoryNew->status = $category->status;
        $categoryNew->created_at = $category->created_at;
        $categoryNew->updated_at = $category->updated_at;

        return $categoryNew;
    }
}
