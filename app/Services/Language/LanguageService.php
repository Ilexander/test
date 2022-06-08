<?php

namespace App\Services\Language;

use App\Http\Requests\Language\LanguageAllInterface;
use App\Http\Requests\Language\LanguageCreateInterface;
use App\Http\Requests\Language\LanguageDeleteInterface;
use App\Http\Requests\Language\LanguageInfoInterface;
use App\Http\Requests\Language\LanguageUpdateInterface;
use App\Interfaces\Repositories\LanguageInterface;
use App\Services\Image\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LanguageService
{
    private LanguageInterface $repo;
    private ImageService $imageService;

    /**
     * @param LanguageInterface $repo
     * @param ImageService $imageService
     */
    public function __construct(LanguageInterface $repo, ImageService $imageService)
    {
        $this->repo = $repo;
        $this->imageService = $imageService;
    }

    /**
     * @param LanguageAllInterface $all
     * @return Collection
     */
    public function all(LanguageAllInterface $all): Collection
    {
        return $this->repo->all($all);
    }

    /**
     * @param LanguageInfoInterface $info
     * @return Model
     */
    public function info(LanguageInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param LanguageCreateInterface $create
     * @return Model
     */
    public function create(LanguageCreateInterface $create): Model
    {
        if ($create->getImage()) {
            $create->setImageUrl(
                $this->imageService->saveImage($create->getImage())
            );
        }

        return $this->repo->create($create);
    }

    /**
     * @param LanguageUpdateInterface $update
     * @return bool
     */
    public function update(LanguageUpdateInterface $update): bool
    {
        if ($update->getImage()) {
            $update->setImageUrl(
                $this->imageService->saveImage($update->getImage())
            );
        }

        return $this->repo->update($update);
    }

    /**
     * @param LanguageDeleteInterface $delete
     * @return bool
     */
    public function delete(LanguageDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }
}
