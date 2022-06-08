<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryAllRequest;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryDeleteRequest;
use App\Http\Requests\Category\CategoryInfoRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\Category;
use App\Models\Ticket;
use App\Services\Category\CategoryFacade;
use App\Services\Ticket\TicketFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * @param CategoryAllRequest $request
     * @return View
     */
    public function list(CategoryAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $pageConfigs = ['pageHeader' => false];

        return view('admin.category', [
            'pageConfigs' => $pageConfigs,
            'categories' => CategoryFacade::list($request),
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    /**
     * @param CategoryCreateRequest $request
     * @return RedirectResponse
     */
    public function add(CategoryCreateRequest $request): RedirectResponse
    {
        CategoryFacade::create($request);

        return redirect()->route('admin.category.list',
            [
                'language' => Config::get('language.current')
            ]
        );
    }

    /**
     * @param CategoryUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(CategoryUpdateRequest $request): RedirectResponse
    {
        CategoryFacade::update($request);

        return redirect()->route('admin.category.list', ['language' => Config::get('language.current')]);
    }

    /**
     * @param CategoryDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(CategoryDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => CategoryFacade::delete($request)]);
    }

    /**
     * @param CategoryInfoRequest $request
     * @return JsonResponse
     */
    public function info(CategoryInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => CategoryFacade::info($request)]);
    }

    public function changeStatus(Request $request)
    {
        Category::query()
            ->whereIn('id', $request->ids)
            ->update([
                'status' => json_decode($request->status)
            ]);

        return response()->json(['status' => true]);
    }
}
