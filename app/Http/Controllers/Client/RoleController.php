<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleAllRequest;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Requests\Role\RoleDeleteRequest;
use App\Http\Requests\Role\RoleInfoRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Services\Role\RoleFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

/**
 * Class RoleController
 * @package App\Http\Controllers\Client
 */
class RoleController extends Controller
{
    /**
     * @param RoleAllRequest $request
     * @return View
     */
    public function list(RoleAllRequest $request): View
    {
        $pageConfigs = ['pageHeader' => false];

        return view('home.role.role', [
            'pageConfigs' => $pageConfigs,
            'roles' => RoleFacade::all($request)
        ]);
    }

    /**
     * @param RoleCreateRequest $request
     * @return RedirectResponse
     */
    public function create(RoleCreateRequest $request): RedirectResponse
    {
        RoleFacade::create($request);

        return redirect()->route('role.list', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param RoleInfoRequest $request
     * @return JsonResponse
     */
    public function info(RoleInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => RoleFacade::info($request)]);
    }

    /**
     * @param RoleDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(RoleDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => RoleFacade::delete($request)]);
    }

    /**
     * @param RoleUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(RoleUpdateRequest $request): RedirectResponse
    {
        RoleFacade::update($request);

        return redirect()->route('role.list', ['language' => Config::get('app.locale')]);
    }
}
