<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Setting\SettingItemDTO;
use App\DTO\Translation\TranslationItemDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Language\LanguageAllRequest;
use App\Http\Requests\Setting\SettingAllRequest;
use App\Http\Requests\Setting\SettingCreateRequest;
use App\Http\Requests\Setting\SettingInfoRequest;
use App\Http\Requests\Setting\SettingUpdateRequest;
use App\Http\Requests\Ticket\TicketAllRequest;
use App\Models\Settings;
use App\Models\Ticket;
use App\Services\Language\LanguageFacade;
use App\Services\Payment\PPGate\PayPalGatewayClient;
use App\Services\Setting\SettingFacade;
use App\Services\Ticket\TicketFacade;
use App\Services\Translation\TranslationFacade;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(SettingAllRequest $request): View
    {
        $allTickets = new TicketAllRequest();
        $allTickets->merge([
            'filter_status' => (Auth::user()->isAdmin() ? Ticket::WAIT_FOR_ADMIN_ANSWER : Ticket::WAIT_FOR_USER_ANSWER)
        ]);

        $translations = TranslationFacade::getByEntityType(Settings::class);

        $mappingTranslations = [];

        foreach ($translations as $translation) {
            $mappingTranslations[$translation->language_id][$translation->title] = $translation;
        }

        return view('admin.settings.general', [
            'settings' => SettingFacade::list($request)->keyBy('field_name')->toArray(),
            'page' => $request->getPageName(),
            'languages' => LanguageFacade::all(new LanguageAllRequest()),
            'translations' => $mappingTranslations,
            "tickets" => TicketFacade::getAllTickets($allTickets)
        ]);
    }

    public function store(SettingCreateRequest $request): JsonResponse
    {
        $imageUrl = '';
        if ($request->hasFile('field_value')) {

            $file = $request->file('field_value');

            $prefix = Str::snake(Carbon::now()->format('Y-m-d_H:i'));

            Storage::disk('public_uploads')
                ->putFileAs('/setting/upload/uploads/logoPhotos/', $file, $prefix . '_' . $file->getClientOriginalName());

            $imageUrl = url('/') . '/setting/upload/uploads/logoPhotos/' . $prefix . '_' . $file->getClientOriginalName();
        }

        if ($request->getLanguageName() && $request->getLanguageName() === Settings::DEFAULT_LANGUAGE) {
            $create = new SettingItemDTO(
                $request->getPageName(),
                $request->getFieldName(),
                ($imageUrl === '' ? $request->getFieldValue() : $imageUrl)
            );

            return response()->json([
                'setting' => SettingFacade::create($create)
            ]);
        } elseif ($request->getLanguageId()) {

            $filter = new SettingAllRequest();
            $filter->merge([
                'page_name' => $request->getPageName(),
                'field_name' => $request->getFieldName()
            ]);

            $setting = SettingFacade::list($filter)->first();

            $translationDTO = new TranslationItemDTO(
                    $request->getFieldName(),
                    $request->getFieldValue(),
                    Settings::class,
                    $setting->id,
            );
            $translationDTO->setLanguageId($request->getLanguageId());

            TranslationFacade::create($translationDTO);

            return response()->json([
                'status' => true
            ]);
        }

        $create = new SettingItemDTO(
            $request->getPageName(),
            $request->getFieldName(),
            ($imageUrl === '' ? $request->getFieldValue() : $imageUrl)
        );

        return response()->json([
            'setting' => SettingFacade::create($create)
        ]);
    }

    public function update(SettingUpdateRequest $request): JsonResponse
    {
        return response()->json([
            'status' => SettingFacade::update($request)
        ]);
    }

    public function info(SettingInfoRequest $request): JsonResponse
    {
        return response()->json([
            'setting' => SettingFacade::info($request)
        ]);
    }

    public function mainTenance(): JsonResponse
    {
        $mainTenance = Settings::query()->where('field_name', 'main_tenance_mode')->first();

        if ($mainTenance) {

            Settings::query()
                ->where('field_name', 'main_tenance_mode')
                ->update([
                    'page_name' => 'global',
                    'field_name' => 'main_tenance_mode',
                    'field_value' => !(bool)$mainTenance->field_value
                ]);
        } else {
            Settings::query()
                ->insert([
                    'page_name' => 'global',
                    'field_name' => 'main_tenance_mode',
                    'field_value' => true
                ]);
        }

        return response()->json([
            'status' => true
        ]);
    }

    public function test()
    {
        $apiUrl = 'https://au107.dock-automate.xyz/p2';
        $client_id = '2';
        $secret_key = 'gftjQTgEUR8ypG7Cs6QtnLwAS45UCGgZKySBPeWBNZRz3pzpK85cAQKLcRjk24xGAVNpkrdjgmx8CGYPJx3hKJ3hRz';

        $c = new PayPalGatewayClient($apiUrl, $client_id, $secret_key);
        $r = $c->getTransactionInfo(8989);
//        $r = $c->getCheckoutUrl([
//            'transactionId' => time(),
//            'amount' => 10,
//            'currency' => 'USD'
//        ]);
        dd($r);
    }
}
