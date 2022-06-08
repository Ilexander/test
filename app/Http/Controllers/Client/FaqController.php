<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\FaqAllRequest;
use App\Http\Requests\Faq\FaqCreateRequest;
use App\Http\Requests\Faq\FaqDeleteRequest;
use App\Http\Requests\Faq\FaqInfoRequest;
use App\Http\Requests\Faq\FaqUpdateRequest;
use App\Http\Requests\Language\LanguageAllRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\Faq;
use App\Models\Ticket;
use App\Services\Blog\BlogFacade;
use App\Services\Faq\FaqFacade;
use App\Services\Language\LanguageFacade;
use App\Services\Ticket\TicketFacade;
use App\Services\Translation\TranslationFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class FaqController extends Controller
{
    /**
     * @param FaqAllRequest $request
     * @return View
     */
    public function all(FaqAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $pageConfigs = ['pageHeader' => false];

//        dd(FaqFacade::all($request), Config::get('language.current'), Config::get('app.locale'));

        return view('user.faq', [
            'pageConfigs' => $pageConfigs,
            'faqs' => FaqFacade::all($request),
            'languages' => LanguageFacade::all(new LanguageAllRequest()),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    /**
     * @param FaqCreateRequest $request
     * @return RedirectResponse
     */
    public function create(FaqCreateRequest $request): RedirectResponse
    {
        FaqFacade::create($request);

        return redirect()->route('user.faq.all', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param FaqUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(FaqUpdateRequest $request): RedirectResponse
    {
        FaqFacade::update($request);

        return redirect()->route('user.faq.all', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param FaqInfoRequest $request
     * @return JsonResponse
     */
    public function info(FaqInfoRequest $request): JsonResponse
    {
        return response()->json([
            'data' => FaqFacade::info($request),
            'translate' => TranslationFacade::getByEntityData(Faq::class, $request->id)
        ]);
    }

    /**
     * @param FaqDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(FaqDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => FaqFacade::delete($request)]);
    }
}
