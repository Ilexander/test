<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\AddDepartmentRequest;
use App\Http\Requests\Department\DeleteDepartmentRequest;
use App\Http\Requests\Department\EditDepartmentRequest;
use App\Http\Requests\Department\MemberDepartmentRequest;
use App\Services\Department\DepartmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    private DepartmentService $service;

    public function __construct(DepartmentService $service)
    {
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function list(): View
    {
        $pageConfigs = [
            'pageHeader' => false,
            'pageClass' => 'kanban-application',
        ];

        return view('home.department.department', [
            'pageConfigs' => $pageConfigs,
            'departments' => $this->service->list(),
        ]);
    }

    /**
     * @param AddDepartmentRequest $request
     * @return RedirectResponse
     */
    public function add(AddDepartmentRequest $request): RedirectResponse
    {
        $this->service->add($request);

        return redirect()->route('department.list', ['language' => Config::get('language.current')]);
    }

    /**
     * @param DeleteDepartmentRequest $request
     * @return RedirectResponse
     */
    public function delete(DeleteDepartmentRequest $request): RedirectResponse
    {
        $this->service->delete($request);

        return redirect()->route('department.list', ['language' => Config::get('language.current')]);
    }

    /**
     * @param EditDepartmentRequest $request
     * @return RedirectResponse
     */
    public function edit(EditDepartmentRequest $request): RedirectResponse
    {
        $this->service->edit($request);

        return redirect()->route('department.list', ['language' => Config::get('language.current')]);
    }

    /**
     * @param MemberDepartmentRequest $request
     * @return JsonResponse
     */
    public function members(MemberDepartmentRequest $request): JsonResponse
    {
        return response()->json($this->service->members($request));
    }
}
