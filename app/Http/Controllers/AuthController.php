<?php

namespace App\Http\Controllers;

use App\Helpers\EnvHelper;
use App\Helpers\ServerHelper;
use App\Http\Requests\Api\ApiDocs\ApiDocsAllRequest;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Category\CategoryAllRequest;
use App\Http\Requests\Faq\FaqAllRequest;
use App\Http\Requests\Language\LanguageAllRequest;
use App\Http\Requests\Service\ServiceAllRequest;
use App\Http\Requests\Setting\SettingAllRequest;
use App\Http\Requests\User\UserCreateRequest;
use App\Mail\PasswordResetMail;
use App\Models\Settings;
use App\Models\User;
use App\Services\Api\ApiDocFacade;
use App\Services\Category\CategoryFacade;
use App\Services\Email\PasswordRecoveryService;
use App\Services\Faq\FaqFacade;
use App\Services\Language\LanguageFacade;
use App\Services\Service\ServiceFacade;
use App\Services\Session\SessionFacade;
use App\Services\Setting\SettingFacade;
use App\Services\Setting\SettingService;
use App\Services\TimeService;
use App\Services\Translation\TranslationFacade;
use App\Services\User\BlockUserService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;


class AuthController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function register(TimeService $service): View
    {
        return view('auth.register', [
            'timezoneList' => $service->getTimezoneList()
        ]);
    }

    public function start(TimeService $service)
    {
        return view('start', [
            'timezoneList' => $service->getTimezoneList()
        ]);
    }

    public function setDataBaseSetting(Request $request)
    {
        if (!EnvHelper::databaseStatus()) {
            EnvHelper::updateEnv([
                'DB_HOST' => $request->db_host,
                'DB_PORT' => $request->db_port,
                'DB_DATABASE' => $request->db_database,
                'DB_USERNAME' => $request->db_username,
                'DB_PASSWORD' => $request->db_password,
            ]);

            Artisan::call('migrate');

            User::query()->create([
                "email"                 => $request->email,
                "password"              => bcrypt($request->password),
                "role_id"               => User::ROLE_ADMIN,
                "first_name"            => $request->first_name,
                "last_name"             => $request->last_name,
                "timezone"              => $request->timezone
            ]);
        }
    }

    /**
     * @param UserCreateRequest $request
     * @return JsonResponse
     */
    public function create(UserCreateRequest $request): JsonResponse
    {
        $this->service->create($request);
        Auth::attempt(['email' => $request->getEmail(), "password" => $request->getPassword()]);

        return response()->json([
            'redirect_url' => route(($request->getRoleId() === User::ROLE_CLIENT ? "user." : "admin.").'dashboard',
                ['language' => Config::get('app.locale')])
        ]);
    }

    public function login(LoginRequest $loginRequest, TimeService $service, SettingService $settingService): View
    {
        $languages = LanguageFacade::all(new LanguageAllRequest())->keyBy('alt');

        $languageId = $languages[strtoupper(Config::get('app.locale'))]
            ? $languages[strtoupper(Config::get('app.locale'))]->id
            : $languages[Config::get('app.locale')]->id;

        $translations = TranslationFacade::getByEntityType(Settings::class);

        $mappingTranslations = [];

        foreach ($translations as $translation) {
            $mappingTranslations[$translation->language_id][$translation->title] = $translation;
        }

        $request = new SettingAllRequest();
        $request->merge([
            'page_name' => Settings::TRANSLATION_SETTINGS
        ]);

        return view('auth.login', [
            'timezoneList' => $service->getTimezoneList(),
            'login_settings' => SettingFacade::list($request)->keyBy('field_name')->toArray(),
            'is_autologin' => $loginRequest->getAutologin(),
            'email' => $loginRequest->getEmail(),
            'password' => $loginRequest->getPassword(),
            'translation' => $mappingTranslations[$languageId] ?? [],
            'faqs' => FaqFacade::all(new FaqAllRequest()),
        ]);
    }

    public function auth(AuthRequest $request, BlockUserService $blockUserService): RedirectResponse
    {
        Log::info(json_encode($request->all()));
        Log::info(json_encode($request->autologin));
        $blockCount = $blockUserService->getTryCount($request->getEmail());

        if ($blockCount < 6) {

            if (Auth::attempt(['email' => $request->getEmail(), "password" => $request->getPassword()])) {

                // SessionFacade::create(Auth::user()->id, ServerHelper::getIp());

                if (Auth::user()->isAdmin()) {
                    return redirect()->route('admin.dashboard', ['language' => Config::get('app.locale')]);
                }

                return redirect()->route('user.dashboard', ['language' => Config::get('app.locale')]);
            }

            if ($request->autologin) {

                return redirect()->route('auth.login', ['language' => Config::get('app.locale')]);
            }

            return redirect()->back()->withErrors(['error-login' => 'wrong credential']);

        }

        return redirect()->back()->withErrors(['error-login' => 'this account is blocked']);
    }

    public function logOut() {
        Session::flush();
        Auth::logout();

        return redirect()->route('auth.login', ['language' => Config::get('app.locale')]);
    }

    public function services(ServiceAllRequest $request)
    {
        return view('auth.service', [
            'services' => ServiceFacade::formResponseCollection(ServiceFacade::all($request)),
            'categories' => CategoryFacade::list(new CategoryAllRequest()),
        ]);
    }

    public function api(ApiDocsAllRequest $request)
    {
        return view('auth.api-doc', [
            'apiDocs' => ApiDocFacade::list($request)
        ]);
    }

    public function faq(FaqAllRequest $request)
    {
        return view('auth.faq', [
            'faqs' => FaqFacade::all($request),
            'languages' => LanguageFacade::all(new LanguageAllRequest())
        ]);
    }

    public function policy()
    {
        $requestTranslation = new SettingAllRequest();
        $requestTranslation->merge([
            'page_name' => Settings::TRANSLATION_SETTINGS
        ]);

        $requestContent = new SettingAllRequest();
        $requestContent->merge([
            'page_name' => Settings::TERMS_POLICY_PAGE_SETTINGS
        ]);

        return view('auth.policy', [
            'page_translation' => SettingFacade::list($requestTranslation)->keyBy('field_name')->toArray(),
            'page_content' => SettingFacade::list($requestContent)->keyBy('field_name')->toArray()
        ]);
    }

    public function passwordReset (Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $token = Str::random(64);

        DB::table('password_resets')
            ->insert([
                'email' => $request->email,
                'token' => $token
            ]);
        /** @var User $user */
        $user = User::query()->where('email', $request->email)->first();
        $service = new PasswordRecoveryService(route('auth.password.change', [
            'language' => Config::get('app.locale'),
            'token' => $token
        ]));
        $service->setUser($user);
        $service->formData();
        $service->sendMail();

//        Mail::to(User::query()->where('email', $request->email)->first())
//            ->send(new PasswordResetMail($token));

        return redirect()->route('auth.login', ['language' => Config::get('app.locale')]);
    }

    public function changePassword(string $lang, string $token)
    {
        $check = DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if ($check) {
           return view('auth.reset', [
               'token' => $token
           ]);
        }

        return redirect()->route('auth.login', ['language' => Config::get('app.locale')]);
    }

    public function restorePassword(Request $request): RedirectResponse
    {
        $res = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        User::query()
            ->where('email', $res->email)
            ->update([
                'password' => bcrypt($request->newpassword)
            ]);

        return redirect()->route('auth.login', ['language' => Config::get('app.locale')]);
    }

    public function timeZones(TimeService $service): JsonResponse
    {
        return response()->json([
            'result' => $service->getTimezoneList()
        ]);
    }
}
