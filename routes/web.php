<?php

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
Route::impersonate();
Auth::routes();
//Authentication

Route::get('/login', 'AuthenticationController@login')->name('login');
Route::post('/googleLogin/{user}', 'Auth\LoginController@googleLogin')->name('googleLogin');
Route::get('/registration', 'AuthenticationController@registration')->name('registration');
Route::get('/recover-password', 'AuthenticationController@recoverPassword')->name('recover-password');
Route::get('/confirm-email', 'AuthenticationController@confirmEmail')->name('confirm-email');
Route::get('/lock-screen', 'AuthenticationController@lockScreen')->name('lock-screen');
Route::get('/authenticator', 'AuthenticationController@authenticatorView')->name('authenticator.view');
Route::get('/reply/{id}', 'UserPublicController@reply')->name('reply.view');
Route::post('/recover/password', 'UserPublicController@sendPassword')->name("user.recover.password");
Route::get('/newPassword/{id}', 'AuthenticationController@newPassword')->name('newPassword');
Route::post('/resetclavenew', 'Admin\UserController@resetclavenew')->name('resetclavenew');

//Dashboard Routes
Route::middleware('auth')->group(function () {
    Route::prefix('system')->middleware('role:Administrador')->group(function () {
        Route::get('/', 'Admin\SystemController@index')->name('system.index');
        Route::post('/update', 'Admin\SystemController@update')->name('system.update');
        Route::get('/command/weakLeg', 'Admin\SystemController@weakLeg')->name('system.command.weak_leg');
        Route::get('/command/regenerateRanks', 'Admin\SystemController@regenerateRanks')->name('system.command.regenerateRanks');
    });

    Route::prefix('crud')->middleware('role:Administrador')->group(function () {
        Route::resource('user', Admin\UserController::class);
        Route::prefix('user')->group(function () {
            Route::post('/add/balance', 'Admin\UserController@addBalance')->name('user.add.balance');
            Route::get('/a2fa/{user}', 'Admin\UserController@deactivateA2fa')->name('crud.deactivate.a2fa');
            Route::post('/add/balance/legacy', 'Admin\UserController@addBalanceLegacy')->name('user.add.balance.legacy');
            Route::get('/ajax/list', 'Admin\UserController@ajaxList')->name('user.ajax.list');
            Route::post('/create/payment', 'PaymentController@createPayment')->name('create.payment');
            Route::post('/search/payment', 'SearchPaymentController@get_tx_ids')->name('search.payment');
            Route::get('/reset/password/{user}', 'Admin\UserController@resetPassword')->name('user.reset.password');
            Route::get('/has/vip/{val}/{user}', 'Admin\UserController@hasVip')->name('user.has.vip');

            Route::post('/changedPassword', 'Admin\UserController@changedPassword')->name('user.changed.Password');
            Route::delete('delete', 'Admin\UserController@destroy_user')->middleware("role:Administrador")->name('user.delete');
        });
        Route::prefix('user')->group(function () {
            Route::get('/roi/index', 'Admin\AdminController@roi')->name('roi.index');
            Route::get('/roi/new', 'Admin\AdminController@roiNew')->name('roi.new');
            Route::post('/roi/execute', 'Admin\AdminController@roiExecute')->name('roi.execute');
        });
        // Route::post('/user/wallet/payment/{membership}', 'UserPublicController@payWallet')->name('wallet.pay.membership');
        Route::resource('menu', Admin\MenuController::class);
        Route::resource('kyc', Admin\KycController::class);
        Route::resource('subscription', Admin\SubscriptionController::class);
        Route::get('/kyc/status/{kyc}/{status}/{comment?}', 'Admin\KycController@updateApprovedState')->name('kyc.status.update');
        Route::post('/kyc/status/{kyc}', 'Admin\KycController@updateRejectState')->name('kyc.status.reject');
        Route::get('/kyc/download/{kycDocument}', 'Admin\KycController@downloadDocument')->name('admin.kyc.download');
        Route::post('kyc/search', 'Admin\KycController@searchByFilter')->name('kyc.search.filters');

        Route::resource('task', Admin\TaskController::class);
        Route::resource('detail', Admin\TaskDetailController::class);
        Route::resource('roles', Admin\RolesController::class);
        Route::resource('product', Admin\ProductController::class);
        Route::resource('payment', Admin\PaymentController::class);
        Route::resource('roiPayment', Admin\RoiPaymentController::class);
        Route::resource('rankAdmin', Admin\rankAdminController::class);

        Route::post('payment/search', 'Admin\PaymentController@searchByFilter')->name('payment.search.filters');
        Route::post('roi/search', 'Admin\RoiPaymentController@searchByFilter')->name('roi.search.filters');
        Route::post('payment/action', 'Admin\PaymentController@actionForm')->name('payment.action');
        Route::post('roi/action', 'Admin\RoiPaymentController@actionForm')->name('roi.action');


        Route::post('payment/legacy/action', 'Admin\PaymentController@actionForm')->name('legacy.payment.action');
        Route::prefix('ticket')->group(function () {
            Route::get('/', 'Admin\MembershipController@index')->name('membership.index');
            Route::get('detail/{userMembership}', 'Admin\MembershipController@detail')->name('membership.detail');
            Route::post('assign', 'Admin\UserController@assignMembership')->name('user.membership.assign');
            Route::post('verificationConfirm', 'Admin\MembershipController@verificationConfirm')->name('membership.confirm');
            Route::get('download/{membershipVerifications}', 'Admin\MembershipController@downloadDocument')->name('membership.download');
            Route::get('/list', 'Admin\MembershipController@list')->name('membership.list');
            Route::get('/edit/{membership}', 'Admin\MembershipController@edit')->name('membership.edit');
            Route::put('/update', 'Admin\MembershipController@update')->name('membership.update');
            Route::post('/store', 'Admin\MembershipController@store')->name('membership.store');
            Route::get('/create', 'Admin\MembershipController@create')->name('membership.create');
        });
        Route::prefix('calendar')->group(function () {
            Route::get('/', 'Admin\CalendarController@index')->name('crud.calendar.index');
            Route::post('/add/event', 'Admin\CalendarController@store')->name('crud.calendar.add.event');
        });

        Route::prefix('ticket')->group(function () {
            Route::prefix('category')->group(function () {
                Route::get('/', 'Admin\TicketController@category_index')->name('category.index');
                Route::get('/edit/{category}', 'Admin\TicketController@category_edit')->name('category.edit');
                Route::get('/create', 'Admin\TicketController@category_create')->name('category.create');
                Route::post('/store', 'Admin\TicketController@category_store')->name('category.store');
                Route::put('/update/{category}', 'Admin\TicketController@category_update')->name('category.update');
                Route::delete('/destroy/{category}', 'Admin\TicketController@category_destroy')->name('category.destroy');
                Route::get('/active/{category}/{active}', 'Admin\TicketController@category_active')->name('category.active');
            });
            Route::prefix('priority')->group(function () {
                Route::get('/', 'Admin\TicketController@priority_index')->name('priority.index');
                Route::get('/edit/{priority}', 'Admin\TicketController@priority_edit')->name('priority.edit');
                Route::get('/create', 'Admin\TicketController@priority_create')->name('priority.create');
                Route::post('/store', 'Admin\TicketController@priority_store')->name('priority.store');
                Route::put('/update/{priority}', 'Admin\TicketController@priority_update')->name('priority.update');
                Route::delete('/destroy/{priority}', 'Admin\TicketController@priority_destroy')->name('priority.destroy');
                Route::get('/active/{priority}/{active}', 'Admin\TicketController@priority_active')->name('priority.active');
            });
            Route::prefix('status')->group(function () {
                Route::get('/', 'Admin\TicketController@status_index')->name('status.index');
                Route::get('/edit/{status}', 'Admin\TicketController@status_edit')->name('status.edit');
                Route::get('/create', 'Admin\TicketController@status_create')->name('status.create');
                Route::post('/store', 'Admin\TicketController@status_store')->name('status.store');
                Route::put('/update/{status}', 'Admin\TicketController@status_update')->name('status.update');
                Route::delete('/destroy/{status}', 'Admin\TicketController@status_destroy')->name('status.destroy');
                Route::get('/active/{status}/{active}', 'Admin\TicketController@status_active')->name('status.active');
            });
        });
        Route::prefix('pool')->group(function () {
            Route::get('/List', 'Admin\UserController@listPoolUpgrade')->name('list.pool.upgrades');
            Route::post('/confirm/upgrade', 'Admin\UserController@confirmPoolUpgrade')->name('confirm.pool.upgrade');
            Route::get('/status/{pool}/{status}', 'Admin\UserController@approvedPoolUpgrade')->name('approved.pool.upgrade');
            Route::delete('/delete/{pool}', 'Admin\UserController@destroyPoolUpgrade')->name('destroy.pool.upgrade');

        });

        Route::get('/Shoppinghistory/', 'Admin\ShoppingHistoryController@index')->name('shoppinghistory.index');
        Route::get('/SponserTop/', 'Admin\SponserController@index')->name('SponserTop.index');
        Route::get('/SponserTop/detail/{id}', 'Admin\SponserController@detail')->name('SponserTop.detail');
        Route::get('/ReporteCoinbase/', 'Admin\CoinbaseController@index')->name('ReporteCoinbase.index');
        Route::post('/ReporteCoinbase/filters', 'Admin\CoinbaseController@filtersCoinbase')->name('report.coinbase.filters');
        Route::get('/report/commissions', 'Admin\BalanceController@index')->name('report.balance.index');
        Route::post('/report/commissions/filters', 'Admin\BalanceController@filters')->name('report.balance.filters');

    });


    Route::get('/email', 'UserPublicController@listEmail')->name('user.email');
    Route::post('/send/email', 'UserPublicController@sendEmail')->name('send.email');
    Route::get('/user/calendar', 'UserPublicController@calendar')->name('calendar');
    Route::get('/pricing/{type?}', 'UserPublicController@pricing')->name('user.pricing');
    Route::get('/kyc', 'UserPublicController@kyc')->name('user.kyc');
    Route::post('/kyc/store', 'Admin\KycController@store')->name('user.kyc.store');
    Route::get('/kyc/download/{kycDocument}/{type?}', 'Admin\KycController@download')->name('user.kyc.download');
    Route::get('/wallet', 'UserPublicController@wallet')->name('user.wallet');
    Route::get('/roi', 'UserPublicController@roi')->name('user.roi');
    Route::get('/settings', 'UserPublicController@settings')->name('user.settings');
    Route::post('/activate/a2fa', 'UserPublicController@activateA2fa')->name('user.active.a2fa');
    Route::post('/deactivate/a2fa', 'UserPublicController@deactivateA2fa')->name('user.deactivate.a2fa');
    Route::resource('profile', UserProfileController::class);
    Route::put('/profile/user/changedPassword/{user}', 'UserProfileController@userChangedPassword')->name('profile.user.changedPassWord');
    Route::get('/payment', 'UserPublicController@payment')->name('user.payment');
    Route::get('/paymentRoi', 'UserPublicController@roiRetirement')->name('user.paymentRoi');
    Route::post('/payment/request', 'UserPublicController@savePaymentRequest')->name('user.save.payment');
    Route::post('/payment/request/roi', 'UserPublicController@savePaymentROIRequest')->name('user.save.roi');
    Route::post('/transfer', 'UserPublicController@transfer')->name('user.transfer');
    Route::get('/multilevel', 'UserPublicController@multilevel')->name('user.multilevel');
    Route::get('/multilevel/tree', 'UserPublicController@multilevelTree')->name('user.multilevel.tree');
    Route::get('/multilevel/position/{position}', 'UserPublicController@updatePosition')->name('user.multilevel.position');
    Route::get('/add/user/reference', 'UserPublicController@addUserReferenced')->name('user.add.reference');
    Route::post('/create/user/reference', 'UserPublicController@createUserReferenced')->name('user.create.reference');
    Route::post('/user/wallet/payment/{membership}', 'UserPublicController@payWallet')->name('wallet.pay.membership');
    Route::post('/create/payment', 'PaymentController@createPayment')->name('create.payment');
    Route::post('/load/payment/verification', 'UserPublicController@loadVerificationPayment')->name('user.load.verification');
    Route::get('/membership/download/{membershipVerifications}', 'Admin\MembershipController@downloadDocument')->name('membership.download');
    Route::resource('news', NewsController::class);
    Route::post('/reinvestment', 'UserPublicController@reinvestment')->name('user.reinvestment');
    Route::get('/subscription/register', 'UserPublicController@subscriptionRegister')->name('subscription.register');
    Route::get('/ranks', 'UserPublicController@ranksList')->name('user.ranks.list');
    Route::post('/upgrade/pool/membership', 'UserPublicController@upgradePoolMembership')->name('user.upgrade.pool');
    Route::get('downloadFile/{id}/{table}/{type?}', 'UserPublicController@generalDownloads')->name('general.downloads');
    Route::post('/load/payment/coinbase', 'UserPublicController@loadVerificationCoinbase')->name('user.load.coinbase');
    Route::get('CoinbaseSuccess/{id}', 'UserPublicController@CoinbaseSuccess')->name('CoinbaseSuccess');
    Route::get('CoinbaseCancel/{id}', 'UserPublicController@CoinbaseCancel')->name('CoinbaseCancel');
    Route::get('CoinbaseRecheck/{id}', 'UserPublicController@recheck')->name('user.recheck');
    Route::get('/bonus/retained', 'UserPublicController@bonusRetained')->name('user.bonus.retained');
    Route::get('/bonus/retained/ajax', 'UserPublicController@bonusRetained_ajax')->name('user.bonus.retained_ajax');

    Route::post('/load/payment/mercadopago', 'UserPublicController@loadMercadoPago')->name('user.load.mercadopago');
    Route::get('MercadoPagoSuccess/{id}', 'UserPublicController@MercadoPagoSuccess')->name('MercadoPagoSuccess');
    Route::get('MercadoPagofailure/{id}', 'UserPublicController@MercadoPagofailure')->name('MercadoPagofailure');

    Route::get('/user/Shoppinghistory/', 'Admin\ShoppingHistoryController@Usershopping')->name('user.shoppinghistory.index');
    Route::get('CancelPlan/{id}/{membership}', 'UserPublicController@CancelPlan')->name('user.cancel.plan');

    Route::prefix('tickets')->group(function () {
        Route::get('/', 'UserPublicController@listTickets')->name('user.ticket');
        Route::post('/store', 'UserPublicController@storeTickets')->name('user.ticket.store');
        Route::get('/create', 'UserPublicController@tickets')->name('user.ticket.create');
        Route::post('/response', 'UserPublicController@responseTicket')->name('user.ticket.reponse');
        Route::get('/detail/{ticket}', 'UserPublicController@detailTickets')->name('user.ticket.detail');
        Route::get('/download/create/{ticket}/{type?}', 'UserPublicController@downloadTicket')->name('user.ticket.download');
        Route::get('/download/response/{response}/{type?}', 'UserPublicController@downloadTicketResponse')->name('user.ticket.download.response');
        Route::get('/filters', 'UserPublicController@searchTicket')->name('user.search.ticket');
        Route::get('/status/{ticket}/{status_id}', 'UserPublicController@updateState')->name('tickets.status.update');
    });
    Route::prefix('report')->group(function () {
        Route::get('/referred', 'ReportsController@referred_index')->name('report.referred.index');
        Route::get('/referred/ajax/', 'ReportsController@referred_ajax')->name('report.referred.ajax');
    });

    Route::get('/close/account', 'UserPublicController@closeAccount')->name('user.close.account');
});


Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');
/*
Route::get('/make/link', function () {
    Artisan::call('storage:link');
});
*/


