<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionAllRequest;
use App\Http\Requests\Permission\PermissionCreateRequest;
use App\Http\Requests\Permission\PermissionDeleteRequest;
use App\Http\Requests\Permission\PermissionInfoRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Services\Permission\PermissionFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionController
 * @package App\Http\Controllers\Client
 */
class PermissionController extends Controller
{
    public function all(): JsonResponse
    {
        return response()->json(['data' => PermissionFacade::all()]);
    }
    /**
     * @param PermissionAllRequest $request
     * @return View
     */
    public function list(PermissionAllRequest $request):View
    {
        $pageConfigs = ['pageHeader' => false];

        return view('home.permission.permission', [
            'pageConfigs' => $pageConfigs,
            'permissions' => PermissionFacade::list($request)
        ]);
    }

    /**
     * @param PermissionCreateRequest $request
     * @return RedirectResponse
     */
    public function create(PermissionCreateRequest $request): RedirectResponse
    {
        PermissionFacade::create($request);

        return redirect()->route('permission.list', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param PermissionUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(PermissionUpdateRequest $request): RedirectResponse
    {
        PermissionFacade::update($request);

        return redirect()->route('permission.list', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param PermissionDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(PermissionDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => PermissionFacade::delete($request)]);
    }

    /**
     * @param PermissionInfoRequest $request
     * @return JsonResponse
     */
    public function info(PermissionInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => PermissionFacade::info($request)]);
    }
}
