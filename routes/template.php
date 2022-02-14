<?php
Route::middleware('auth')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
//    Route::get('/dashboard-2', 'DashboardController@dashboardTwo')->name('dashboard-2');
//    Route::get('/analytics', 'DashboardController@analytics')->name('analytics');
//    Route::get('/tracking', 'DashboardController@tracking')->name('tracking');
//    Route::get('/web-analytics', 'DashboardController@webAnalytics')->name('web-analytics');
//    Route::get('/patient', 'DashboardController@patientDashboard')->name('patient');
//    Route::get('/ticket-booking', 'DashboardController@ticketBooking')->name('ticket-booking');
//
//
////UI elements
//    Route::get('/ui-color', 'UIElementController@color')->name('ui-color');
//    Route::get('/ui-typography', 'UIElementController@typography')->name('ui-typography');
//    Route::get('/ui-alert', 'UIElementController@alert')->name('ui-alert');
//    Route::get('/ui-badges', 'UIElementController@badges')->name('ui-badges');
//    Route::get('/ui-breadcrumb', 'UIElementController@breadCrumb')->name('ui-breadcrumb');
//    Route::get('/ui-button', 'UIElementController@button')->name('ui-button');
//    Route::get('/ui-card', 'UIElementController@card')->name('ui-card');
//    Route::get('/ui-carousel', 'UIElementController@carousel')->name('ui-carousel');
//    Route::get('/ui-video', 'UIElementController@video')->name('ui-video');
//    Route::get('/ui-grid', 'UIElementController@grid')->name('ui-grid');
//    Route::get('/ui-images', 'UIElementController@images')->name('ui-images');
//    Route::get('/ui-listgroup', 'UIElementController@listGroup')->name('ui-listgroup');
//    Route::get('/ui-media', 'UIElementController@medai')->name('ui-media');
//    Route::get('/ui-modal', 'UIElementController@modal')->name('ui-modal');
//    Route::get('/ui-notifications', 'UIElementController@notifications')->name('ui-notifications');
//    Route::get('/ui-pagination', 'UIElementController@pagination')->name('ui-pagination');
//    Route::get('/ui-popovers', 'UIElementController@popovers')->name('ui-popovers');
//    Route::get('/ui-progressbars', 'UIElementController@progressbars')->name('ui-progressbars');
//    Route::get('/ui-tabs', 'UIElementController@tabs')->name('ui-tabs');
//    Route::get('/ui-tooltips', 'UIElementController@tooltips')->name('ui-tooltips');
//
////form elements
//    Route::get('/form-layout', 'FormElementController@formLayout')->name('form-layout');
//    Route::get('/form-validation', 'FormElementController@formValidation')->name('form-validation');
//    Route::get('/form-switch', 'FormElementController@formSwitch')->name('form-switch');
//    Route::get('/form-chechbox', 'FormElementController@formChechbox')->name('form-chechbox');
//    Route::get('/form-radio', 'FormElementController@formRadio')->name('form-radio');
//    Route::get('/form-wizard', 'FormElementController@formWizard')->name('form-wizard');
//    Route::get('/validate-wizard', 'FormElementController@formValidateWizard')->name('validate-wizard');
//    Route::get('/vertical-wizard', 'FormElementController@formVerticalWizard')->name('vertical-wizard');
//
////calnder chat  todo routes
////    Route::get('/calendar', 'CalendarController@index')->name('calendar');
////    Route::get('/chat', 'CalendarController@chat')->name('chat');
////    Route::get('/todo', 'CalendarController@todo')->name('todo');
//
////Table
//    Route::get('e-commerce', 'EcommerceController@index')->name('e-commerce');
//    Route::get('e-commerce/checkout', 'EcommerceController@checkOut')->name('checkout');
//    Route::get('e-commerce/product-detail', 'EcommerceController@productDetail')->name('productDetail');
//
//    Route::get('/basic-table', 'TableController@basicTable')->name('basic-table');
//    Route::get('/data-table', 'TableController@dataTable')->name('data-table');
//    Route::get('/edit-table', 'TableController@editTable')->name('edit-table');
//
////Chart
//
//    Route::get('/chart-morris', 'ChartController@chartMorris')->name('chart-morris');
//    Route::get('/chart-high', 'ChartController@chartHigh')->name('chart-high');
//    Route::get('/chart-am', 'ChartController@chartAm')->name('chart-am');
//    Route::get('/chart-apex', 'ChartController@chartApex')->name('chart-apex');
//
//
////Icon
//    Route::get('/icon-dripicons', 'IconController@dripicons')->name('icon-dripicons');
//    Route::get('/icon-fontawesome', 'IconController@fontAwesome')->name('icon-fontawesome');
//    Route::get('/icon-lineawesome', 'IconController@lineAwesome')->name('icon-lineawesome');
//    Route::get('/icon-remixicon', 'IconController@remixicon')->name('icon-remixicon');
//    Route::get('/icon-unicons', 'IconController@unicons')->name('icon-unicons');
//
////ExtraPages
//
//    Route::get('/timeline', 'ExtraPagesController@timeline')->name('timeline');
//    Route::get('/invoice', 'ExtraPagesController@invoice')->name('invoice');
//    Route::get('/blank-pages', 'ExtraPagesController@blankPages')->name('blank-pages');
//    Route::get('/error-400', 'ExtraPagesController@error400')->name('error-400');
//    Route::get('/error-500', 'ExtraPagesController@error500')->name('error-500');
//    Route::get('/pricing', 'ExtraPagesController@pricing')->name('pricing');
//    Route::get('/pricing-one', 'ExtraPagesController@pricingOne')->name('pricing-one');
//    Route::get('/maintenance', 'ExtraPagesController@maintenance')->name('maintenance');
//    Route::get('/comingsoon', 'ExtraPagesController@commingSoon')->name('comingsoon');
//    Route::get('/faq', 'ExtraPagesController@faq')->name('faq');
//
////Map
//    Route::get('/google-map', 'MapController@googleMap')->name('google-map');
//
//
////email
//
//    Route::get('/mail', 'MailController@mail')->name('mail');
//    Route::get('/compose-mail', 'MailController@composeMail')->name('compose-mail');
//
////User
//
//    Route::get('/profile', 'UserController@profile')->name('profile');
//    Route::get('/profile-edit', 'UserController@profileEdit')->name('profile_edit');
//    Route::get('/add-user', 'UserController@addUser')->name('add_user');
//    Route::get('/user-list', 'UserController@userList')->name('user_list');
//
////Setting
//
//    Route::get('/account-settings', 'SettingController@accountSetting')->name('account_settings');
//    Route::get('/privacy-settings', 'SettingController@privacySetting')->name('privacy_settings');
//    Route::get('/privacy-policy', 'SettingController@privacyPolicy')->name('privacy_policy');
//    Route::get('/terms-of-service', 'SettingController@termsService')->name('terms_of_service');
});
