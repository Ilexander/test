<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\PaymentAllRequest;
use App\Http\Requests\Role\RoleAllRequest;
use App\Http\Requests\Role\RoleInfoRequest;
use App\Http\Requests\Service\ServiceAllRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Http\Requests\User\UserAllRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserDeleteRequest;
use App\Http\Requests\User\UserInfoRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\Payment\PaymentFacade;
use App\Services\Role\RoleFacade;
use App\Services\Service\ServiceFacade;
use App\Services\Ticket\TicketFacade;
use App\Services\TimeService;
use App\Services\User\UserFacade;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private UserService $service;
    private TimeService $timeService;

    /**
     * @param UserService $service
     * @param TimeService $timeService
     */
    public function __construct(UserService $service, TimeService $timeService)
    {
        $this->service = $service;
        $this->timeService = $timeService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function changeStatus(Request $request): JsonResponse
    {
        $user = User::query()->find($request->id);

        return response()->json([
            'status' => User::query()
                ->where('id', $request->id)
                ->update([
                    'status' => !$user->status
                ])
        ]);
    }

    public function list(): JsonResponse
    {
        return response()->json(UserFacade::list());
    }

    public function edit($lang, User $user)
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        return view('admin.user-edit', [
            'user' => $user,
            'statuses' => User::STATUS_LIST,
            'payments' => PaymentFacade::list(new PaymentAllRequest()),
            'timezoneList' => $this->timeService->getTimezoneList(),
            'canceledPayments' => $user->canceledPayments->pluck('payment_id')->toArray(),
            'user_more_information' => json_decode($user->more_information, true),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    /**
     * @param UserAllRequest $request
     * @param TimeService $timeService
     * @return View
     */
    public function all(UserAllRequest $request, TimeService $timeService): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $pageConfigs = ['pageHeader' => false];

        return view('admin.users', [
            'services' => ServiceFacade::formResponseCollection(ServiceFacade::all(new ServiceAllRequest())),
            'pageConfigs' => $pageConfigs,
            'timezoneList' => $timeService->getTimezoneList(),
            'users' => UserFacade::all($request),
            'roles' => RoleFacade::all(new RoleAllRequest()),
            "tickets" => TicketFacade::getAllTickets($allTickets),
            'filters' => [
                'email' => $request->getEmailFilter(),
                'first_last_name' => $request->getFirstLastNameFilter()
            ]
        ]);
    }

    /**
     * @param UserInfoRequest $request
     * @return JsonResponse
     */
    public function info(UserInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => UserFacade::info($request)]);
    }

    /**
     * @param UserDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(UserDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => UserFacade::delete($request)]);
    }

    /**
     * @param UserCreateRequest $request
     * @return RedirectResponse
     */
    public function add(UserCreateRequest $request): RedirectResponse
    {
        $role = new RoleInfoRequest();
        $role->merge(['id' => $request->getRoleId()]);

        UserFacade::create($request,$role);

        return redirect()->route('user.all', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param UserUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request): RedirectResponse
//    public function update(Request $request): RedirectResponse
    {
        if (!Auth::user()->isAdmin()) {

            if ( $request->getId() != Auth::user()->id ) {
                return redirect()->route('user.profile', ['language' => Config::get('app.locale')]);
            }

            $request->merge([
                'role_id' => Auth::user()->role_id
            ]);
        }

        $userInfo = new UserInfoRequest();
        $userInfo->merge([
            'id' => $request->getId()
        ]);
        $user = UserFacade::info($userInfo);

        $role = new RoleInfoRequest();
        $role->merge([
            'id' => $request->getRoleName()
                ? Role::query()->where('name', $request->getRoleName())->first()->id
                : ($request->getRoleId() ?? $user->role_id)
        ]);

        UserFacade::update($request, $role);

        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.user.edit', [
                'language' => Config::get('app.locale'),
                'user' => $request->getId(),
            ]);
        }

        return redirect()->route('user.profile', ['language' => Config::get('app.locale')]);
    }

    public function loginAsUser(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = User::query()->find($request->id);
        Auth::login($user);

        Session::put('asUserLogin', true);

        return response()->json(['status' => true]);
    }

    public function impersonate($lang, $id)
    {
        if (Session::get('asUserLogin')) {
            Session::put('asUserLogin', false);

            /** @var User $user */
            $user = User::query()->find($id);
            Auth::login($user);

            return redirect()->route('user.dashboard', ['language' => Config::get('app.locale')]);
        }
    }
}
