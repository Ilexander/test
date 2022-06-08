<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Translation\GetTranslationByEntityRequest;
use App\Http\Requests\Translation\RemoveTranslationByEntityRequest;
use App\Services\Translation\TranslationFacade;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function removeByEntity(RemoveTranslationByEntityRequest $request): JsonResponse
    {
        return response()->json([
            'result' => TranslationFacade::deleteByEntityType($request->getEntityType())
        ]);
    }

    public function getByEntity(GetTranslationByEntityRequest $request): JsonResponse
    {
        return response()->json([
            'result' => TranslationFacade::getByEntityType($request->getEntityType())
        ]);
    }
}
