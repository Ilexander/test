<?php

namespace App\Http\Controllers\Client;

use App\DTO\User\UserPersonalPriceCollectionDTO;
use App\DTO\User\UserPersonalPriceDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceAllRequest;
use App\Http\Requests\User\UserAllRequest;
use App\Http\Requests\UserPrice\UserPriceAllRequest;
use App\Http\Requests\UserPrice\UserPriceCreateRequest;
use App\Http\Requests\UserPrice\UserPriceDeleteRequest;
use App\Http\Requests\UserPrice\UserPriceInfoRequest;
use App\Http\Requests\UserPrice\UserPriceUpdateRequest;
use App\Services\Service\ServiceFacade;
use App\Services\User\UserFacade;
use App\Services\UserPrice\UserPriceFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class UserPriceController extends Controller
{
    /**
     * @param UserPriceAllRequest $request
     * @return View
     */
    public function all(UserPriceAllRequest $request): View
    {
        $pageConfigs = ['pageHeader' => false];

        return view('home.user-price.user-price', [
            'pageConfigs' => $pageConfigs,
            'userPrices'  => UserPriceFacade::all($request),
            'services'    => ServiceFacade::all(new ServiceAllRequest()),
            'users'       => UserFacade::all(new UserAllRequest())
        ]);
    }

    /**
     * @param UserPriceInfoRequest $request
     * @return JsonResponse
     */
    public function info(UserPriceInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => UserPriceFacade::info($request)]);
    }

    /**
     * @param UserPriceCreateRequest $request
     * @return RedirectResponse
     */
    public function create(UserPriceCreateRequest $request): RedirectResponse
    {
        $personalPrices = new UserPersonalPriceCollectionDTO();

        if ($request->getServiceId() && $request->getServicePrice()) {
            $personalPrices->setItem(new UserPersonalPriceDTO(
                $request->getUserId(),
                $request->getServiceId(),
                $request->getServicePrice()
            ));
        } else {
            UserPriceFacade::deletePricesByUserId($request->getUserId());
        }

        $addedServices = [];

        foreach ($request->getServices() as $key => $service) {
            if (!in_array($service, $addedServices)) {
                $personalPrices->setItem(new UserPersonalPriceDTO(
                    $request->getUserId(),
                    $service,
                    $request->getServicePrices()[$key]
                ));
                $addedServices[] = $service;
            }
        }

        UserPriceFacade::create($personalPrices);

        return redirect()->route('admin.user.all', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param UserPriceUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(UserPriceUpdateRequest $request): RedirectResponse
    {
        UserPriceFacade::update($request);

        return redirect()->route('user-price.all', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param UserPriceDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(UserPriceDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => UserPriceFacade::delete($request)]);
    }

    public function deleteForUser(Request $request): JsonResponse
    {
        return response()->json(['status' => UserPriceFacade::deletePricesByUserId($request->user_id)]);
    }
}
