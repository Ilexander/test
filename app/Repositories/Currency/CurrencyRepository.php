<?php

namespace App\Repositories\Currency;

use App\DTO\Currency\CurrencyItemDTO;
use App\Http\Requests\Currency\CurrencyAllInterface;
use App\Http\Requests\Currency\CurrencyCreateInterface;
use App\Http\Requests\Currency\CurrencyUpdateInterface;
use App\Interfaces\Repositories\CurrencyInterface;
use App\Models\Currency;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CurrencyRepository
 * @package App\Repositories\Currency
 */
class CurrencyRepository implements CurrencyInterface
{
    private Currency $currency;

    /**
     * CurrencyRepository constructor.
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @param CurrencyCreateInterface $create
     * @return bool
     */
    public function add(CurrencyCreateInterface $create): bool
    {
        try {
            $this
                ->currency
                ->newQuery()
                ->create([
                    'name'          => $create->getName(),
                    'description'   => $create->getDescription(),
                ]);

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @param CurrencyItemDTO $delete
     * @return bool
     */
    public function delete(CurrencyItemDTO $delete): bool
    {
        return $this
            ->currency
            ->newQuery()
            ->find($delete->getId())
            ->delete();
    }

    /**
     * @param CurrencyUpdateInterface $update
     * @return bool
     */
    public function update(CurrencyUpdateInterface $update): bool
    {
        return $this
            ->currency
            ->newQuery()
            ->where('id', $update->getId())
            ->update([
                'name'          => $update->getName(),
                'description'   => $update->getDescription(),
            ]);
    }

    /**
     * @param CurrencyItemDTO $info
     * @return Model|null
     */
    public function info(CurrencyItemDTO $info): ?Model
    {
        return $this->currency->newQuery()->find($info->getId());
    }

    /**
     * @param CurrencyAllInterface $all
     * @return Collection
     */
    public function all(CurrencyAllInterface $all): Collection
    {
        return $this->currency->newQuery()->get();
    }

    public function list(): Collection
    {
        return $this->currency->newQuery()->get();
    }
}
