<?php

namespace App\Services\Blog;

use App\DTO\Blog\BlogItemDTO;
use App\Http\Requests\Blog\BlogAllInterface;
use App\Http\Requests\Blog\BlogCreateInterface;
use App\Http\Requests\Blog\BlogDeleteInterface;
use App\Http\Requests\Blog\BlogInfoInterface;
use App\Http\Requests\Blog\BlogUpdateInterface;
use App\Http\Requests\Language\LanguageAllRequest;
use App\Interfaces\Repositories\BlogInterface;
use App\Interfaces\Repositories\LanguageInterface;
use App\Interfaces\Repositories\TranslationInterface;
use App\Models\Blog;
use App\Services\Image\ImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BlogService
{
    private BlogInterface $repo;
    private ImageService $imageService;
    private LanguageInterface $languageRepo;
    private TranslationInterface $translationRepo;

    /**
     * @param BlogInterface $repo
     * @param ImageService $imageService
     * @param LanguageInterface $languageRepo
     * @param TranslationInterface $translationRepo
     */
    public function __construct(
        BlogInterface $repo,
        ImageService $imageService,
        LanguageInterface $languageRepo,
        TranslationInterface $translationRepo
    ) {
        $this->repo = $repo;
        $this->imageService = $imageService;
        $this->languageRepo = $languageRepo;
        $this->translationRepo = $translationRepo;
    }

    /**
     * @param BlogAllInterface $all
     * @return Collection
     */
    public function all(BlogAllInterface $all): Collection
    {
        return $this->repo->all($all);
    }

    /**
     * @param BlogInfoInterface $info
     * @return Model
     */
    public function info(BlogInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param BlogCreateInterface $create
     * @return Model
     */
    public function create(BlogCreateInterface $create): Model
    {
        if (!$create->getSort()) {
            $create->setSort($this->calculateSort());
        }

        if ($create->getImage()) {
            $create->setImageUrl($this->imageService->saveImage($create->getImage()));
        }

        $languages = $this->languageRepo->all(new LanguageAllRequest());

        $blogDefaultTranslation = $create->getTranslation(Blog::DEFAULT_LANGUAGE);

        $blogItem = new BlogItemDTO(
            $create->getUserId(),
            $blogDefaultTranslation->getTitle(),
            $blogDefaultTranslation->getContext(),
            $create->getCategory(),
            $create->getImageUrl(),
            $create->getMetaKeywords(),
            $create->getMetaDescription(),
            $create->getStatus(),
            $create->getSort(),
            $create->getUrlSlug()
        );

        /** @var Blog $blog */
        $blog = $this->repo->create($blogItem);

        foreach ($languages as $language) {
            $translation = $create->getTranslation($language->name);

            if($translation && $language->name !== Blog::DEFAULT_LANGUAGE) {
                $translation
                    ->setItemId($blog->id)
                    ->setItemType(Blog::class)
                    ->setLanguageId($language->id);

                $this->translationRepo->create($translation);
            }
        }

        return $blog;
    }

    /**
     * @param BlogUpdateInterface $update
     * @return bool
     */
    public function update(BlogUpdateInterface $update): bool
    {
        if (!$update->getSort()) {
            $update->setSort($this->calculateSort());
        }

        if ($update->getImage()) {
            $update->setImageUrl($this->imageService->saveImage($update->getImage()));
        }

        $languages = $this->languageRepo->all(new LanguageAllRequest());

        $blogDefaultTranslation = $update->getTranslation(Blog::DEFAULT_LANGUAGE);

        $blogItem = new BlogItemDTO(
            $update->getUserId(),
            $blogDefaultTranslation->getTitle(),
            $blogDefaultTranslation->getContext(),
            $update->getCategory(),
            $update->getImageUrl(),
            $update->getMetaKeywords(),
            $update->getMetaDescription(),
            $update->getStatus(),
            $update->getSort(),
            $update->getUrlSlug()
        );

        $res = $this->repo->update($blogItem,  $update->getId());

        $this->translationRepo->deleteByEntityData(Blog::class, $update->getId());

        foreach ($languages as $language) {
            $translation = $update->getTranslation($language->name);

            if ($translation && $language->name !== Blog::DEFAULT_LANGUAGE) {
                $translation
                    ->setItemId($update->getId())
                    ->setItemType(Blog::class)
                    ->setLanguageId($language->id);

                $this->translationRepo->create($translation);
            }
        }

        return $res;
    }

    /**
     * @param BlogDeleteInterface $delete
     * @return bool
     */
    public function delete(BlogDeleteInterface $delete): bool
    {
        $this->translationRepo->deleteByEntityData(Blog::class, $delete->getId());

        return $this->repo->delete($delete);
    }

    private function calculateSort(): int
    {
        /** @var Blog $last */
        $last = Blog::query()->get()->last();
        $newSort = 1;

        if ($last) {
            $newSort += $last->sort;
        }

        return $newSort;
    }
}