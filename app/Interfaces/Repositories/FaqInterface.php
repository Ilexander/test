<?php

namespace App\Interfaces\Repositories;

use App\DTO\Translation\TranslationItemDTO;
use App\Http\Requests\Faq\FaqAllInterface;
use App\Http\Requests\Faq\FaqCreateInterface;
use App\Http\Requests\Faq\FaqDeleteInterface;
use App\Http\Requests\Faq\FaqInfoInterface;
use App\Http\Requests\Faq\FaqUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface FaqInterface
{
    /**
     * @param FaqAllInterface $all
     * @return Collection
     */
    public function all(FaqAllInterface $all): Collection;

    /**
     * @param FaqInfoInterface $info
     * @return Model
     */
    public function info(FaqInfoInterface $info): Model;

    /**
     * @param TranslationItemDTO $create
     * @return Model
     */
    public function create(TranslationItemDTO $create): Model;

    /**
     * @param TranslationItemDTO $update
     * @param int $id
     * @return bool
     */
    public function update(TranslationItemDTO $update, int $id): bool;

    /**
     * @param FaqDeleteInterface $delete
     * @return bool
     */
    public function delete(FaqDeleteInterface $delete): bool;
}