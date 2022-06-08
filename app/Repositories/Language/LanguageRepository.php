<?php

namespace App\Repositories\Language;

use App\Helpers\ArrayHelper;
use App\Http\Requests\Language\LanguageAllInterface;
use App\Http\Requests\Language\LanguageCreateInterface;
use App\Http\Requests\Language\LanguageDeleteInterface;
use App\Http\Requests\Language\LanguageInfoInterface;
use App\Http\Requests\Language\LanguageUpdateInterface;
use App\Interfaces\Repositories\LanguageInterface;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LanguageRepository implements LanguageInterface
{
    private Language $language;

    /**
     * @param Language $language
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    /**
     * @param LanguageAllInterface $all
     * @return Collection
     */
    public function all(LanguageAllInterface $all): Collection
    {
        return $this
            ->language
            ->newQuery()
            ->when((Auth::user() && !Auth::user()->isAdmin()), function ($query, $user) {
                return $query->where('status', true);
            })
            ->get();
    }

    /**
     * @param LanguageCreateInterface $create
     * @return Model
     */
    public function create(LanguageCreateInterface $create): Model
    {
        /** @var Language $language */
        $language = new $this->language();
        $language->fill([
            'name'                  => $create->getName(),
            'alt'                   => $create->getAlt(),
            'supported_countries'   => json_encode($create->getSupportedCountries()),
            'status'                => $create->getStatus(),
            'image_url'             => $create->getImageUrl(),
            'view'                  => $create->getView()
        ]);
        $language->save();

        return $language;
    }

    /**
     * @param LanguageInfoInterface $info
     * @return Model
     */
    public function info(LanguageInfoInterface $info): Model
    {
        return $this->language->newQuery()->find($info->getId());
    }

    /**
     * @param LanguageUpdateInterface $update
     * @return bool
     */
    public function update(LanguageUpdateInterface $update): bool
    {
        return $this
            ->language
            ->newQuery()
            ->where('id', $update->getId())
            ->update(ArrayHelper::filterEmpty([
                'name'                  => $update->getName(),
                'alt'                   => $update->getAlt(),
                'supported_countries'   => json_encode($update->getSupportedCountries()),
                'status'                => $update->getStatus(),
                'image_url'             => $update->getImageUrl(),
                'view'                  => $update->getView()
            ]));
    }

    /**
     * @param LanguageDeleteInterface $delete
     * @return bool
     */
    public function delete(LanguageDeleteInterface $delete): bool
    {
        return $this
            ->language
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
            ->delete();
    }
}
