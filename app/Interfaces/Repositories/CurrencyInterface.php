<?php

namespace App\Interfaces\Repositories;

use App\DTO\Currency\CurrencyItemDTO;
use App\Http\Requests\Currency\CurrencyAllInterface;
use App\Http\Requests\Currency\CurrencyCreateInterface;
use App\Http\Requests\Currency\CurrencyDeleteInterface;
use App\Http\Requests\Currency\CurrencyInfoInterface;
use App\Http\Requests\Currency\CurrencyUpdateInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface CurrencyInterface
 * @package App\Interfaces\Repositories
 */
interface CurrencyInterface
{
    /**
     * @param CurrencyCreateInterface $create
     * @return bool
     */
    public function add(CurrencyCreateInterface $create): bool;

    /**
     * @param CurrencyItemDTO $delete
     * @return bool
     */
    public function delete(CurrencyItemDTO $delete): bool;

    /**
     * @param CurrencyUpdateInterface $update
     * @return bool
     */
    public function update(CurrencyUpdateInterface $update): bool;

    /**
     * @param CurrencyItemDTO $info
     * @return Model|null
     */
    public function info(CurrencyItemDTO $info): ?Model;

    /**
     * @param CurrencyAllInterface $all
     * @return Collection
     */
    public function all(CurrencyAllInterface $all): Collection;

    /**
     * @return Collection
     */
    public function list(): Collection;
}
