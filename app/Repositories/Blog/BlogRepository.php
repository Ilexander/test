<?php

namespace App\Repositories\Blog;

use App\DTO\Blog\BlogItemDTO;
use App\Helpers\ArrayHelper;
use App\Http\Requests\Blog\BlogAllInterface;
use App\Http\Requests\Blog\BlogCreateInterface;
use App\Http\Requests\Blog\BlogDeleteInterface;
use App\Http\Requests\Blog\BlogInfoInterface;
use App\Http\Requests\Blog\BlogUpdateInterface;
use App\Interfaces\Repositories\BlogInterface;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BlogRepository implements BlogInterface
{
    private Blog $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    public function all(BlogAllInterface $all): Collection
    {
        return $this->blog->newQuery()->with(['translation'])->get();
    }

    public function create(BlogItemDTO $create): Model
    {
        /** @var Blog $blog */
        $blog = new $this->blog();
        $blog->fill(ArrayHelper::filterEmpty([
            "user_id"               => $create->getUserId(),
            "title"                 => $create->getTitle(),
            "category"              => $create->getCategory(),
            "url_slug"              => $create->getUrlSlug(),
            "image_url"             => $create->getImageUrl(),
            "content"               => $create->getContent(),
            "meta_keywords"         => $create->getMetaKeywords(),
            "meta_description"      => $create->getMetaDescription(),
            "sort"                  => $create->getSort(),
            "status"                => $create->isStatus(),
        ]));
        $blog->save();

        return $blog;
    }

    public function info(BlogInfoInterface $info): ?Model
    {
        return $this->blog->newQuery()->with(['translation'])->find($info->getId());
    }

    public function update(BlogItemDTO $update, int $id): bool
    {
        return $this
            ->blog
            ->newQuery()
            ->where('id', $id)
            ->where('user_id', $update->getUserId())
            ->update(ArrayHelper::filterEmpty([
                "title"                 => $update->getTitle(),
                "category"              => $update->getCategory(),
                "url_slug"              => $update->getUrlSlug(),
                "image_url"             => $update->getImageUrl(),
                "content"               => $update->getContent(),
                "meta_keywords"         => $update->getMetaKeywords(),
                "meta_description"      => $update->getMetaDescription(),
                "sort"                  => $update->getSort(),
                "status"                => $update->isStatus(),
            ]));
    }

    public function delete(BlogDeleteInterface $delete): bool
    {
        return $this->blog->newQuery()->where('id', $delete->getId())->delete();
    }
}
