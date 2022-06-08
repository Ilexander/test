<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\BlogAllRequest;
use App\Http\Requests\Blog\BlogCreateRequest;
use App\Http\Requests\Blog\BlogDeleteRequest;
use App\Http\Requests\Blog\BlogInfoRequest;
use App\Http\Requests\Blog\BlogUpdateRequest;
use App\Http\Requests\Language\LanguageAllRequest;
use App\Services\Blog\BlogFacade;
use App\Services\Language\LanguageFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * @param BlogAllRequest $request
     * @return View
     */
    public function all(BlogAllRequest $request): View
    {
        $pageConfigs = ['pageHeader' => false];

        return view('home.blog.blog', [
            'pageConfigs' => $pageConfigs,
            'blogs' => BlogFacade::all($request),
            'languages' => LanguageFacade::all(new LanguageAllRequest())
        ]);
    }

    /**
     * @param BlogCreateRequest $request
     * @return RedirectResponse
     */
    public function create(BlogCreateRequest $request): RedirectResponse
    {
        BlogFacade::create($request);

        return redirect()->route('blog.all', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param BlogUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(BlogUpdateRequest $request): RedirectResponse
    {
        BlogFacade::update($request);

        return redirect()->route('blog.all', ['language' => Config::get('app.locale')]);
    }

    /**
     * @param BlogInfoRequest $request
     * @return JsonResponse
     */
    public function info(BlogInfoRequest $request): JsonResponse
    {
        return response()->json(['data' => BlogFacade::info($request)]);
    }

    /**
     * @param BlogDeleteRequest $request
     * @return JsonResponse
     */
    public function delete(BlogDeleteRequest $request): JsonResponse
    {
        return response()->json(['status' => BlogFacade::delete($request)]);
    }
}
