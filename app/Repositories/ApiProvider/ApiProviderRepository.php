<?php

namespace App\Repositories\ApiProvider;

use App\Helpers\ArrayHelper;
use App\Http\Requests\ApiProvider\ApiProviderAllInterface;
use App\Http\Requests\ApiProvider\ApiProviderCreateInterface;
use App\Http\Requests\ApiProvider\ApiProviderDeleteInterface;
use App\Http\Requests\ApiProvider\ApiProviderInfoInterface;
use App\Http\Requests\ApiProvider\ApiProviderUpdateInterface;
use App\Interfaces\Repositories\ApiProviderInterface;
use App\Models\ApiProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ApiProviderRepository implements ApiProviderInterface
{
    private ApiProvider $apiProvider;

    public function __construct(ApiProvider $apiProvider)
    {
        $this->apiProvider = $apiProvider;
    }

    public function list(ApiProviderAllInterface $all): Collection
    {
        return $this
            ->apiProvider
            ->newQuery()
            ->get();
    }

    public function info(ApiProviderInfoInterface $info): ?Model
    {
        return $this
            ->apiProvider
            ->newQuery()
            ->find($info->getId());
    }

    public function create(ApiProviderCreateInterface $create): Model
    {
        /** @var ApiProvider $apiProvider */
        $provider = new $this->apiProvider();
        $provider->fill([
            'user_id'       => $create->getUserId(),
            'name'          => $create->getName(),
            'url'           => $create->getUrl(),
            'key'           => $create->getKey(),
            'type'          => $create->getType(),
            'balance'       => $create->getBalance(),
            'currency_code' => $create->getCurrencyCode(),
            'description'   => $create->getDescription(),
            'status'        => $create->getStatus()
        ]);
        $provider->save();

        return $provider;
    }

    public function update(ApiProviderUpdateInterface $update): bool
    {
        return $this
            ->apiProvider
            ->newQuery()
            ->where('id', $update->getId())
            ->where('user_id', $update->getUserId())
            ->update(ArrayHelper::filterEmpty([
                'name'          => $update->getName(),
                'url'           => $update->getUrl(),
                'key'           => $update->getKey(),
                'type'          => $update->getType(),
                'balance'       => $update->getBalance(),
                'currency_code' => $update->getCurrencyCode(),
                'description'   => $update->getDescription(),
                'status'        => $update->getStatus()
            ]));
    }

    public function delete(ApiProviderDeleteInterface $delete): bool
    {
        return $this
            ->apiProvider
            ->newQuery()
            ->where('id', $delete->getId())
            ->where('user_id', $delete->getUserId())
            ->delete();
    }
}
