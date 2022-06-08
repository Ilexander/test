<?php

namespace App\Repositories\Faq;

use App\DTO\Translation\TranslationItemDTO;
use App\Http\Requests\Faq\FaqAllInterface;
use App\Http\Requests\Faq\FaqCreateInterface;
use App\Http\Requests\Faq\FaqDeleteInterface;
use App\Http\Requests\Faq\FaqInfoInterface;
use App\Http\Requests\Faq\FaqUpdateInterface;
use App\Interfaces\Repositories\FaqInterface;
use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FaqRepository implements FaqInterface
{
    private Faq $faq;

    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function all(FaqAllInterface $all): Collection
    {
        return $this->faq->newQuery()->with(['translation.language'])->get();
    }

    public function info(FaqInfoInterface $info): Model
    {
        return $this->faq->newQuery()->with(['translation'])->find($info->getId());
    }

    public function create(TranslationItemDTO $create): Model
    {
        /** @var Faq $faq */
        $faq = new $this->faq();
        $faq->fill([
            "question"  => $create->getTitle(),
            "answer"    => $create->getContext(),
        ]);
        $faq->save();

        return $faq;
    }

    public function update(TranslationItemDTO $update, int $id): bool
    {
        return $this
            ->faq
            ->newQuery()
            ->where('id', $id)
            ->update([
                "question"  => $update->getTitle(),
                "answer"    => $update->getContext(),
            ]);
    }

    public function delete(FaqDeleteInterface $delete): bool
    {
        return $this->faq->newQuery()->where('id', $delete->getId())->delete();
    }
}
