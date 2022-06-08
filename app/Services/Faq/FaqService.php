<?php

namespace App\Services\Faq;

use App\DTO\Translation\TranslationItemDTO;
use App\Http\Requests\Faq\FaqAllInterface;
use App\Http\Requests\Faq\FaqCreateInterface;
use App\Http\Requests\Faq\FaqDeleteInterface;
use App\Http\Requests\Faq\FaqInfoInterface;
use App\Http\Requests\Faq\FaqUpdateInterface;
use App\Http\Requests\Language\LanguageAllRequest;
use App\Interfaces\Repositories\FaqInterface;
use App\Interfaces\Repositories\LanguageInterface;
use App\Interfaces\Repositories\TranslationInterface;
use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FaqService
{
    private FaqInterface $repo;
    private LanguageInterface $languageRepo;
    private TranslationInterface $translationRepo;

    /**
     * @param FaqInterface $repo
     * @param LanguageInterface $languageRepo
     * @param TranslationInterface $translationRepo
     */
    public function __construct(
        FaqInterface $repo,
        LanguageInterface $languageRepo,
        TranslationInterface $translationRepo
    ) {
        $this->repo = $repo;
        $this->languageRepo = $languageRepo;
        $this->translationRepo = $translationRepo;
    }

    /**
     * @param FaqAllInterface $all
     * @return Collection
     */
    public function all(FaqAllInterface $all): Collection
    {
        return $this->repo->all($all);
    }

    /**
     * @param FaqInfoInterface $info
     * @return Model
     */
    public function info(FaqInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param FaqCreateInterface $create
     * @return Model
     */
    public function create(FaqCreateInterface $create): Model
    {

//        $itemFaq =  new TranslationItemDTO(
//            $create->getQuestion(),
//            $create->getAnswer()
//        );
//
//        return $this->repo->create($itemFaq);

        $languages = $this->languageRepo->all(new LanguageAllRequest());

        /** @var Faq $faq */
        $faq = $this->repo->create($create->getTranslation(Faq::DEFAULT_LANGUAGE));

        foreach ($languages as $language) {
            $translation = $create->getTranslation($language->name);

            if ($translation && $language->name !== Faq::DEFAULT_LANGUAGE) {
                $translation
                    ->setItemId($faq->id)
                    ->setItemType(Faq::class)
                    ->setLanguageId($language->id);

                $this->translationRepo->create($translation);
            }
        }

        return $faq;
    }

    /**
     * @param FaqUpdateInterface $update
     * @return bool
     */
    public function update(FaqUpdateInterface $update): bool
    {
//        $itemFaq =  new TranslationItemDTO(
//            $update->getQuestion(),
//            $update->getAnswer()
//        );
//
//        return $this->repo->update($itemFaq, $update->getId());
        $languages = $this->languageRepo->all(new LanguageAllRequest());

        /** @var Faq $faq */
        $res = $this->repo->update($update->getTranslation(Faq::DEFAULT_LANGUAGE), $update->getId());

        $this->translationRepo->deleteByEntityData(Faq::class, $update->getId());

        foreach ($languages as $language) {
            $translation = $update->getTranslation($language->name);

            if ($translation && $language->name !== Faq::DEFAULT_LANGUAGE) {
                $translation
                    ->setItemId($update->getId())
                    ->setItemType(Faq::class)
                    ->setLanguageId($language->id);

                $this->translationRepo->create($translation);
            }
        }

        return $res;
    }

    /**
     * @param FaqDeleteInterface $delete
     * @return bool
     */
    public function delete(FaqDeleteInterface $delete): bool
    {
        $this->translationRepo->deleteByEntityData(Faq::class, $delete->getId());
        return $this->repo->delete($delete);
    }
}
