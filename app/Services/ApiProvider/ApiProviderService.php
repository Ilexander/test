<?php

namespace App\Services\ApiProvider;

use App\Http\Requests\ApiProvider\ApiProviderAllInterface;
use App\Http\Requests\ApiProvider\ApiProviderCreateInterface;
use App\Http\Requests\ApiProvider\ApiProviderDeleteInterface;
use App\Http\Requests\ApiProvider\ApiProviderInfoInterface;
use App\Http\Requests\ApiProvider\ApiProviderInfoRequest;
use App\Http\Requests\ApiProvider\ApiProviderUpdateInterface;
use App\Interfaces\Repositories\ApiProviderInterface;
use App\Models\ApiProvider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ApiProviderService
{
    private ApiProviderInterface $repo;

    private ApiProviderApiService $apiService;

    /**
     * @param ApiProviderInterface $repo
     * @param ApiProviderApiService $apiService
     */
    public function __construct(ApiProviderInterface $repo, ApiProviderApiService $apiService)
    {
        $this->repo = $repo;
        $this->apiService = $apiService;
    }

    /**
     * @param ApiProviderAllInterface $all
     * @return Collection
     */
    public function list(ApiProviderAllInterface $all): Collection
    {
        return $this->repo->list($all);
    }

    /**
     * @param ApiProviderInfoInterface $info
     * @return Model|null
     */
    public function info(ApiProviderInfoInterface $info): ?Model
    {
        return $this->repo->info($info);
    }

    /**
     * @param ApiProviderCreateInterface $create
     * @return Model
     */
    public function create(ApiProviderCreateInterface $create): Model
    {
        return $this->repo->create($create);
    }

    /**
     * @param ApiProviderUpdateInterface $update
     * @return bool
     */
    public function update(ApiProviderUpdateInterface $update): bool
    {
        return $this->repo->update($update);
    }

    /**
     * @param ApiProviderDeleteInterface $delete
     * @return bool
     */
    public function delete(ApiProviderDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }

    public function services(ApiProviderInfoInterface $info): array
    {
        /** @var ApiProvider $apiProvider */
        $apiProvider = $this->info($info);

        $res = $this->apiService->getApiServicesToProvider(
            $apiProvider->url,
            [
                'key'    => $apiProvider->key,
                'action' => 'services',
            ]
        );

        return json_decode($res, true);
    }

    public function formResponseCollection(Collection $apiProviders): Collection
    {
        return $apiProviders->map(function ($item, $key) {

            return $this->formResponseItem($item);
        });
    }

    public function formResponseItem(ApiProvider $item): ApiProvider
    {
        $apiProviderNew = new ApiProvider();
        $apiProviderNew->id = $item->id;
        $apiProviderNew->user_id = $item->user_id;
        $apiProviderNew->name = $item->name;
        $apiProviderNew->type = $item->type;
        $apiProviderNew->currency_code = $item->currency_code;
        $apiProviderNew->description = $item->description;
        $apiProviderNew->status = $item->status;
        $apiProviderNew->created_at = $item->created_at;
        $apiProviderNew->updated_at = $item->updated_at;

        return $apiProviderNew;
    }
}
