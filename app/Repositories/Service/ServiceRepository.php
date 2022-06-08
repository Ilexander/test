<?php

namespace App\Repositories\Service;

use App\Helpers\ArrayHelper;
use App\Http\Requests\Service\ServiceAllInterface;
use App\Http\Requests\Service\ServiceCreateInterface;
use App\Http\Requests\Service\ServiceDeleteInterface;
use App\Http\Requests\Service\ServiceInfoInterface;
use App\Http\Requests\Service\ServiceUpdateInterface;
use App\Interfaces\Repositories\ServiceInterface;
use App\Models\ApiProvider;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceRepository implements ServiceInterface
{
    private Service $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function all(ServiceAllInterface $all): Collection
    {
        return $this
            ->service
            ->newQuery()
            ->with(['category', 'apiProvider'])
            ->when($all->getCategoryId(), function ($query, $category_id) {
                return $query->where('category_id', $category_id);
            })
            ->when((Auth::user() && !Auth::user()->isAdmin()), function ($query, $user) {
                return $query->where('status', true);
            })
            ->when($all->getStatus(), function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('category_id')
            ->get();
    }

    public function info(ServiceInfoInterface $info): Model
    {
        return $this
            ->service
            ->newQuery()
            ->where('id', $info->getId())
            ->when((Auth::user() && !Auth::user()->isAdmin()), function ($query, $user) {
                return $query->where('status', true);
            })
            ->first();
    }

    public function create(ServiceCreateInterface $create): Model
    {
        /** @var Service $service */
        $service = new $this->service();
        $service->fill([
            'user_id'           => $create->getUserId(),
            'category_id'       => $create->getCategoryId(),
            'name'              => $create->getName(),
            'desc'              => $create->getDesc(),
            'price'             => $create->getPrice(),
            'original_price'    => $create->getOriginalPrice(),
            'min'               => $create->getMin(),
            'max'               => $create->getMax(),
            'add_type'          => $create->getAddType(),
            'type'              => $create->getType(),
            'api_service_id'    => $create->getApiServiceId(),
            'api_provider_id'   => $create->getApiProviderId(),
            'dripfeed'          => $create->getDripFeed(),
            'status'            => $create->getStatus(),
        ]);
        $service->save();

        return $service;
    }

    public function update(ServiceUpdateInterface $update): bool
    {
        return $this
            ->service
            ->newQuery()
            ->where('id', $update->getId())
            ->where('user_id', $update->getUserId())
            ->update(ArrayHelper::filterEmpty([
                'category_id'       => $update->getCategoryId(),
                'name'              => $update->getName(),
                'desc'              => $update->getDesc(),
                'price'             => $update->getPrice(),
                'original_price'    => $update->getOriginalPrice(),
                'min'               => $update->getMin(),
                'max'               => $update->getMax(),
                'add_type'          => $update->getAddType(),
                'type'              => $update->getType(),
                'api_service_id'    => $update->getApiServiceId(),
                'api_provider_id'   => $update->getApiProviderId(),
                'dripfeed'          => $update->getDripFeed(),
                'status'            => $update->getStatus(),
            ]));
    }

    public function delete(ServiceDeleteInterface $delete): bool
    {
        return $this
            ->service
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
            ->when((!Auth::user()->isAdmin()), function ($query, $user){
                return $query->where('user_id', Auth::user()->id);
            })
            ->delete();
    }

    public function getTopBestsellers(?int $user_id): array
    {
        return DB::table((new Service())->getTable())
            ->select(
                'services.id',
                'services.name',
                'services.desc',
                DB::raw('COUNT(o.id) as total_orders'),
                'services.type',
                'ap.name as api_provider',
                'services.api_service_id as api_service_id',
                'services.price as price',
                'services.original_price as original_price',
                'services.min as min',
                'services.max as max',
                'services.status as status',
            )
            ->join((new Order())->getTable().' as o','services.id', '=', 'o.service_id')
            ->join((new ApiProvider())->getTable().' as ap', 'services.api_provider_id','=','ap.id')
            ->groupBy(
                'services.id', 
                'services.name',
                'services.desc',
                'services.type',
                'ap.name', 
                'services.api_service_id',
                'services.price',
                'services.original_price',
                'services.min',
                'services.max',
                'services.status',
            )
            ->orderBy('total_orders','desc')
            ->get()
            ->toArray();
    }
}
