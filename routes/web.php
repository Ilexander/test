<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\ApiController;
use App\Http\Controllers\Client\ApiProviderController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\CurrencyController;
use App\Http\Controllers\Client\DepartmentController;
use App\Http\Controllers\Client\FaqController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\PanelController;
use App\Http\Controllers\Client\PaymentBonusController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\PermissionController;
use App\Http\Controllers\Client\RoleController;
use App\Http\Controllers\Client\ServiceController;
use App\Http\Controllers\Client\SessionController;
use App\Http\Controllers\Client\SubscribeController;
use App\Http\Controllers\Client\TicketController;
use App\Http\Controllers\Client\TicketMessageController;
use App\Http\Controllers\Client\TransactionController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\UserPriceController;
use App\Http\Controllers\Client\LanguageController as SystemLanguageController;
use App\Services\Email\AccountVerificationService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChartsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('maintenance', function (){
    return view('admin.maintenance');
})->name('maintenance');

Route::get('start', [AuthController::class, 'start']);
Route::post('database-setting', [AuthController::class, 'setDataBaseSetting'])->name('database.setting');


Route::group(['prefix' => '{language}/user', 'middleware' => ['lang', 'auth', 'main_tenance'], 'as' => 'user.'], function (){


    Route::get('test', function() {
        return view('admin.maintenance');
    })->name('test');


    Route::get('dashboard', [PanelController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'transaction', 'as' => 'transaction.'], function (){
        Route::post('add', [TransactionController::class, 'add'])->name('add');
        Route::get('list', [TransactionController::class, 'list'])->name('list');
        Route::get('create', [TransactionController::class, 'create'])->name('create');
        Route::get('info', [TransactionController::class, 'info'])->name('info');
    });

    Route::group(['prefix' => 'payment', 'as' => 'payment.'], function (){
        Route::get('all', [PaymentController::class, 'all'])->name('all');
    });

    Route::get('profile', [PanelController::class, 'profile'])->name('profile');
    Route::post('update', [UserController::class, 'update'])->name('profile.update');

    Route::group(['prefix' => 'order', 'as' => 'order.'], function (){
        Route::get('info', [OrderController::class, 'info'])->name('info');
        Route::get('new', [OrderController::class, 'new'])->name('new');
        Route::post('create', [OrderController::class, 'create'])->name('create');
        Route::get('all', [OrderController::class, 'all'])->name('all');
    });

    Route::group(['prefix' => 'service', 'as' => 'service.'], function (){
        Route::get('all', [ServiceController::class, 'all'])->name('all');
    });

    Route::group(['prefix' => 'api-doc', 'as' => 'api-doc.'], function (){
        Route::get('list', [ApiController::class, 'list'])->name('list');
    });

    Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function (){
        Route::post('create', [TicketController::class, 'create'])->name('create');
        Route::get('list', [TicketController::class, 'list'])->name('list');
        Route::get('user', [TicketController::class, 'toUser'])->name('user');
        Route::get('chat', [TicketMessageController::class, 'chat'])->name('chat');
        Route::get('read', [TicketController::class, 'read'])->name('read');

        Route::group(['prefix' => 'message', 'as' => 'message.'], function (){
            Route::post('create', [TicketMessageController::class, 'add'])->name('create');
            Route::get('ticket', [TicketMessageController::class, 'ticket'])->name('ticket');
            Route::get('info', [TicketMessageController::class, 'info'])->name('info');
        });

        Route::group(['prefix' => 'status', 'as' => 'status.'], function (){
            Route::get('list', [TicketController::class, 'getTicketStatusList'])->name('list');
        });
    });

    Route::group(['prefix' => 'faq', 'as' => 'faq.'], function (){
        Route::get('all', [FaqController::class, 'all'])->name('all');
    });

    Route::get('impersonate/{id}', [UserController::class, 'impersonate'])->name('impersonate');

//    Route::group(['prefix' => 'transaction', 'as' => 'transaction.'], function (){
//        Route::get('list', [TransactionController::class, 'list'])->name('list');
//        Route::get('create', [TransactionController::class, 'create'])->name('create');
//        Route::get('info', [TransactionController::class, 'info'])->name('info');
//    });
});

Route::group(['prefix' => '{language}/admin', 'middleware' => ['lang', 'auth', 'main_tenance'], 'as' => 'admin.'], function (){

    Route::post('mainTenance', [SettingController::class, 'mainTenance'])->name('main-tenance');

    Route::group(['prefix' => 'translation', 'as' => 'translation.'], function (){
        Route::get('list', [TranslationController::class, 'getByEntity'])->name('list');
        Route::delete('delete', [TranslationController::class, 'removeByEntity'])->name('delete');
    });

    Route::group(['prefix' => 'order', 'as' => 'order.'], function (){
        Route::get('info', [OrderController::class, 'info'])->name('info');
        Route::put('update', [OrderController::class, 'update'])->name('update');
        Route::get('drip-feed', [OrderController::class, 'dripFeed'])->name('drip-feed');
        Route::delete('delete', [OrderController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'language', 'as' => 'language.'], function (){
        Route::get('all', [SystemLanguageController::class, 'all'])->name('all');
        Route::get('info', [SystemLanguageController::class, 'info'])->name('info');
        Route::put('update', [SystemLanguageController::class, 'update'])->name('update');
        Route::delete('delete', [SystemLanguageController::class, 'delete'])->name('delete');
        Route::post('create', [SystemLanguageController::class, 'create'])->name('create');
        Route::post('change-status', [SystemLanguageController::class, 'changeStatus'])->name('change-status');
        Route::post('countries', [SystemLanguageController::class, 'countriesList'])->name('countries-list');
    });

    Route::group(['prefix' => 'subscription', 'as' => 'subscription.'], function (){
        Route::put('update', [SubscribeController::class, 'update'])->name('update');
        Route::get('info', [SubscribeController::class, 'info'])->name('info');
        Route::get('all', [SubscribeController::class, 'all'])->name('all');
        Route::delete('delete', [SubscribeController::class, 'delete'])->name('delete');
        Route::post('send-mail', [SubscribeController::class, 'sendMail'])->name('send-mail');
    });

    Route::group(['prefix' => 'transaction', 'as' => 'transaction.'], function (){
        Route::put('update', [TransactionController::class, 'update'])->name('update');
        Route::get('info', [TransactionController::class, 'info'])->name('info');
    });
    Route::group(['prefix' => 'payment', 'as' => 'payment.'], function (){
        Route::get('list', [PaymentController::class, 'list'])->name('list');
        Route::delete('delete', [PaymentController::class, 'delete'])->name('delete');
        Route::post('change-status', [PaymentController::class, 'changeStatus'])->name('change-status');
        Route::post('create', [PaymentController::class, 'create'])->name('create');
        Route::put('update', [PaymentController::class, 'update'])->name('update');
        Route::get('info', [PaymentController::class, 'info'])->name('info');

        Route::group(['prefix' => 'payment-bonus', 'as' => 'payment-bonus.'], function (){
            Route::get('list', [PaymentBonusController::class, 'all'])->name('list');
            Route::delete('delete', [PaymentBonusController::class, 'delete'])->name('delete');
            Route::post('change-status', [PaymentBonusController::class, 'changeStatus'])->name('change-status');
            Route::post('create', [PaymentBonusController::class, 'create'])->name('create');
            Route::put('update', [PaymentBonusController::class, 'update'])->name('update');
            Route::get('info', [PaymentBonusController::class, 'info'])->name('info');


        });
    });

    Route::get('dashboard', [PanelController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'ticket', 'as' => 'ticket.'], function (){
        Route::post('create', [TicketController::class, 'create'])->name('create');
        Route::get('list', [TicketController::class, 'list'])->name('list');
        Route::get('read', [TicketController::class, 'read'])->name('read');
        Route::delete('delete', [TicketController::class, 'delete'])->name('delete');

        Route::group(['prefix' => 'status', 'as' => 'status.'], function (){
            Route::get('list', [TicketController::class, 'getTicketStatusList'])->name('list');
            Route::post('update', [TicketController::class, 'changeStatus'])->name('update');
        });

        Route::group(['prefix' => 'message', 'as' => 'message.'], function (){
            Route::post('create', [TicketMessageController::class, 'add'])->name('create');
            Route::get('ticket', [TicketMessageController::class, 'ticket'])->name('ticket');
            Route::get('info', [TicketMessageController::class, 'info'])->name('info');
        });
    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function (){
        Route::get('all', [UserController::class, 'all'])->name('all');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('update', [UserController::class, 'update'])->name('update');
        Route::post('login', [UserController::class, 'loginAsUser'])->name('login-as');
        Route::post('change', [UserController::class, 'changeStatus'])->name('change-status');
    });

    Route::group(['prefix' => 'user-price', 'as' => 'user-price.'], function (){
        Route::post('create', [UserPriceController::class, 'create'])->name('create');
        Route::delete('delete', [UserPriceController::class, 'delete'])->name('delete');
        Route::delete('delete-for-user', [UserPriceController::class, 'deleteForUser'])->name('delete-for-user');
    });

    Route::group(['prefix' => 'service', 'as' => 'service.'], function (){
        Route::get('all', [ServiceController::class, 'all'])->name('all');
        Route::delete('delete', [ServiceController::class, 'delete'])->name('delete');
        Route::post('changeStatus', [ServiceController::class, 'changeStatus'])->name('change-status');
        Route::post('create', [ServiceController::class, 'create'])->name('create');
        Route::put('update', [ServiceController::class, 'update'])->name('update');
        Route::get('info', [ServiceController::class, 'info'])->name('info');
        Route::delete('delete', [ServiceController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'category', 'as' => 'category.'], function (){
        Route::get('list', [CategoryController::class, 'list'])->name('list');
        Route::post('changeStatus', [CategoryController::class, 'changeStatus'])->name('change-status');
        Route::delete('delete', [CategoryController::class, 'delete'])->name('delete');
        Route::post('create', [CategoryController::class, 'add'])->name('create');
        Route::put('update', [CategoryController::class, 'update'])->name('update');
        Route::get('info', [CategoryController::class, 'info'])->name('info');
    });

    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function (){
        Route::get('index', [SettingController::class, 'index'])->name('index');
        Route::post('store', [SettingController::class, 'store'])->name('store');
    });

    Route::group(['prefix' => 'faq', 'as' => 'faq.'], function (){
        Route::get('all', [FaqController::class, 'all'])->name('all');
        Route::get('info', [FaqController::class, 'info'])->name('info');
        Route::post('create', [FaqController::class, 'create'])->name('create');
        Route::put('update', [FaqController::class, 'update'])->name('update');
        Route::delete('delete', [FaqController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'api-provider', 'as' => 'api-provider.'], function (){
        Route::get('services', [ApiProviderController::class, 'getApiProviderServices'])->name('services');
    });
});

Route::group(['prefix' => 'service', 'middleware' => ['main_tenance'], 'as' => 'service.'], function (){
    Route::get('info', [ServiceController::class, 'info'])->name('info');
    Route::get('list', [ServiceController::class, 'list'])->name('list');
});

Route::get('/', function () {
    return redirect()->route('auth.login',   ['language' => 'en']);
})->middleware(['main_tenance']);

Route::get('{language}/', [AuthController::class, 'login'])->middleware(['lang', 'main_tenance'])->name('dashboard');

Route::group(['prefix' => '{language}', 'middleware' => ['lang', 'main_tenance'], 'as' => 'auth.'], function (){
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('create', [AuthController::class, 'create'])->name('create');
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('auth', [AuthController::class, 'auth'])->name('auth');
    Route::get('logout', [AuthController::class, 'logOut'])->name('logout');
    Route::get('service', [AuthController::class, 'services'])->name('services');
    Route::get('api', [AuthController::class, 'api'])->name('api');
    Route::get('faq', [AuthController::class, 'faq'])->name('faq');
    Route::get('policy', [AuthController::class, 'policy'])->name('policy');
    Route::post('forgot-password', [AuthController::class, 'passwordReset'])->name('password.reset');
    Route::get('change-password/{token}', [AuthController::class, 'changePassword'])->name('password.change');
    Route::post('password-restore', [AuthController::class, 'restorePassword'])->name('password.restore');
    Route::post('subscribe', [SubscribeController::class, 'create'])->name('subscribe');
    Route::get('timezones', [AuthController::class, 'timeZones'])->name('time-zones');
});
