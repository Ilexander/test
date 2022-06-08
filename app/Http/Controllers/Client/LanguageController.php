<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\LanguageAllRequest;
use App\Http\Requests\Language\LanguageCreateRequest;
use App\Http\Requests\Language\LanguageDeleteRequest;
use App\Http\Requests\Language\LanguageInfoRequest;
use App\Http\Requests\Language\LanguageUpdateRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\Language;
use App\Models\Ticket;
use App\Services\Language\LanguageFacade;
use App\Services\Ticket\TicketFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Monarobase\CountryList\CountryListFacade;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanguageController extends Controller
{
    public function list(LanguageAllRequest $request): JsonResponse
    {
        return response()->json(['data' => LanguageFacade::all($request)]);
    }
    /**
     * @param LanguageAllRequest $request
     * @return View
     */
    public function all(LanguageAllRequest $request): View
    {
        $pageConfigs = ['pageHeader' => false];

        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        return view('admin.languages', [
            'pageConfigs' => $pageConfigs,
            'languages' => LanguageFacade::all($request),
            'countries' => CountryListFacade::getList(),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    /**
     * @param LanguageCreateRequest $request
     * @return RedirectResponse
     */
    public function create(LanguageCreateRequest $request): RedirectResponse
    {
        LanguageFacade::create($request);

        return redirect()->route('admin.language.all', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param LanguageUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(LanguageUpdateRequest $request): RedirectResponse
    {
        LanguageFacade::update($request);

        return redirect()->route('admin.language.all', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param LanguageDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(LanguageDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => LanguageFacade::delete($request)]);
    }

    /**
     * @param LanguageInfoRequest $request
     * @return JsonResponse
     */
    public function info(LanguageInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => LanguageFacade::info($request)]);
    }

    public function changeStatus(Request $request): JsonResponse
    {
        Language::query()
            ->whereIn('id', $request->ids)
            ->update([
                'status' => json_decode($request->status)
            ]);

        return response()->json(['status' => true]);
    }

    public function countriesList(): JsonResponse
    {
        return response()->json([
            'countries' => CountryListFacade::getList()
        ]);
    }
}
