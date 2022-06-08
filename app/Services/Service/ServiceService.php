<?php

namespace App\Services\Service;

use App\Http\Requests\Service\ServiceAllInterface;
use App\Http\Requests\Service\ServiceCreateInterface;
use App\Http\Requests\Service\ServiceDeleteInterface;
use App\Http\Requests\Service\ServiceInfoInterface;
use App\Http\Requests\Service\ServiceUpdateInterface;
use App\Http\Resources\ApiProvider\ApiProviderInfoResource;
use App\Http\Resources\Category\CategoryInfoResource;
use App\Interfaces\Repositories\ServiceInterface;
use App\Models\Service;
use App\Services\ApiProvider\ApiProviderFacade;
use App\Services\Category\CategoryFacade;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ServiceService
{
    private ServiceInterface $repo;

    public function __construct(ServiceInterface $repo)
    {
        $this->repo = $repo;
    }

    public function all(ServiceAllInterface $all): Collection
    {
        return $this->repo->all($all);
    }

    public function info(ServiceInfoInterface $info): Model
    {
        return $this->repo->info($info);
    }

    public function create(ServiceCreateInterface $create): Model
    {
        return $this->repo->create($create);
    }

    public function update(ServiceUpdateInterface $update): bool
    {
        return $this->repo->update($update);
    }

    public function delete(ServiceDeleteInterface $delete): bool
    {
        return $this->repo->delete($delete);
    }

    public function getTopBestsellers(?int $user_id): array
    {
        return $this->repo->getTopBestsellers($user_id);
    }

    public function formResponseCollection(Collection $payments): Collection
    {
        return $payments->map(function ($item, $key) {

            return $this->formResponseItem($item);
        });
    }

    public function formResponseItem(Service $item): Service
    {
        $serviceNew = new Service();
        $serviceNew->id = $item->id;
        $serviceNew->user_id = $item->user_id;
        $serviceNew->category_id = $item->category_id;
        $serviceNew->name = $item->name;
        $serviceNew->desc = $item->desc;
        $serviceNew->price = $item->price;
        $serviceNew->min = $item->min;
        $serviceNew->max = $item->max;
        $serviceNew->add_type = $item->add_type;
        $serviceNew->type = $item->type;
        $serviceNew->api_provider_id = $item->api_provider_id;
        $serviceNew->dripfeed = $item->dripfeed;
        $serviceNew->status = $item->status;
        $serviceNew->created_at = $item->created_at;
        $serviceNew->updated_at = $item->updated_at;
        $serviceNew->category = (!empty($item->category))
            ? CategoryFacade::fromResponseItem($item->category)
            : [];
        $serviceNew->apiProvider = (!empty($item->apiProvider))
            ? ApiProviderFacade::formResponseItem($item->apiProvider)
            : [];

        return $serviceNew;
    }
}
