<?php

Auth::routes();
//Clear Config cache:
Route::get('/cc', function () {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');

    return '<h1>All Config cleared</h1>';
});
Route::post('visitor/contact', 'VisitorController@visitorcontact');
Route::post('merchant/support', 'VisitorController@merchantsupport');
Route::post('career/apply', 'VisitorController@careerapply');

// Area Selection

Route::get('areas/get_district', 'AreaSelectionController@get_district');
Route::get('areas/get_area', 'AreaSelectionController@get_area');
Route::get('areas/get_union', 'AreaSelectionController@get_union');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    // Division Zone Route
    Route::get('/division/add', 'DivisionControllerNew@add');
    Route::post('/division/save', 'DivisionControllerNew@store');
    Route::get('/division/manage', 'DivisionControllerNew@manage');
    Route::get('/division/edit/{id}', 'DivisionControllerNew@edit');
    Route::post('/division/update', 'DivisionControllerNew@update');
    Route::post('/division/inactive', 'DivisionControllerNew@inactive');
    Route::post('/division/active', 'DivisionControllerNew@active');
    Route::post('/division/delete', 'DivisionControllerNew@destroy');

    // District Zone Route
    Route::get('/up_district/add', 'DistrictControllerNew@add');
    Route::post('/up_district/save', 'DistrictControllerNew@store');
    Route::get('/up_district/manage', 'DistrictControllerNew@manage');
    Route::get('/up_district/edit/{id}', 'DistrictControllerNew@edit');
    Route::post('/up_district/update', 'DistrictControllerNew@update');
    Route::post('/up_district/inactive', 'DistrictControllerNew@inactive');
    Route::post('/up_district/active', 'DistrictControllerNew@active');
    Route::post('/up_district/delete', 'DistrictControllerNew@destroy');

    // Area Zone Route
    Route::get('/area/add', 'AreaControllerNew@add');
    Route::post('/area/save', 'AreaControllerNew@store');
    Route::get('/area/manage', 'AreaControllerNew@manage');
    Route::get('/area/edit/{id}', 'AreaControllerNew@edit');
    Route::post('/area/update', 'AreaControllerNew@update');
    Route::post('/area/inactive', 'AreaControllerNew@inactive');
    Route::post('/area/active', 'AreaControllerNew@active');
    Route::post('/area/delete', 'AreaControllerNew@destroy');

    // Covarage Zone Route
    Route::get('/covarage/add', 'CovarageArea@add');
    Route::post('/covarage/save', 'CovarageArea@store');
    Route::get('/covarage/manage', 'CovarageArea@manage');
    Route::get('/covarage/edit/{id}', 'CovarageArea@edit');
    Route::post('/covarage/update', 'CovarageArea@update');
    Route::post('/covarage/inactive', 'CovarageArea@inactive');
    Route::post('/covarage/active', 'CovarageArea@active');
    Route::post('/covarage/delete', 'CovarageArea@destroy');

});

Route::get('/covarage/list', 'CovarageArea@list');
Route::get('/covarage/fetch_data', 'CovarageArea@fetch_data');

Route::group(['namespace' => 'FrontEnd'], function () {
    Route::get('/', 'FrontEndController@index');
    Route::get('/about-us', 'FrontEndController@aboutus');
    Route::get('/contact-us', 'FrontEndController@contact');
    Route::get('/our-service/{id}', 'FrontEndController@ourservice');

    Route::get('/blog', 'FrontEndController@blog');
    Route::get('/blog/details/{id}', 'FrontEndController@blogdetails');
    Route::get('/price', 'FrontEndController@price');
    Route::get('/pick-drop', 'FrontEndController@pickndrop');
    Route::get('/branches', 'FrontEndController@branch');
    Route::get('/termscondition', 'FrontEndController@termscondition');
    Route::get('/faq', 'FrontEndController@faq');
    Route::get('/notice', 'FrontEndController@notice');
    Route::get('/notice/{id}/{slug}', 'FrontEndController@noticedetails');
    Route::get('/gallery', 'FrontEndController@gallery');
    Route::get('/privacy-policy', 'FrontEndController@privacy');
    Route::get('/features', 'FrontEndController@features');
    Route::get('/features/details/{id}', 'FrontEndController@featuredetails');
    Route::post('/track/parcel/', 'FrontEndController@parceltrack');
    Route::get('/track/parcel/{id}', 'FrontEndController@parceltrackget');
    Route::get('delivery/charge/{id}', 'FrontEndController@delivryCharge');
    Route::get('/cost/calculate/{packageid}/{cod}/{weight}', 'FrontEndController@costCalculate');
    Route::get('cost/calculate/result', 'FrontEndController@costCalculateResult');

    // Merchant Operation
    Route::get('merchant/register', 'MerchantController@registerpage');
    Route::post('auth/merchant/register', 'MerchantController@register');
    Route::get('merchant/login', 'MerchantController@loginpage');
    Route::post('merchant/login', 'MerchantController@login');
    Route::get('/merchant/phone-verify', 'MerchantController@phoneVerifyForm');
    Route::post('merchant/phone-resend', 'MerchantController@phoneresendcode');
    Route::post('/merchant/phone-verify', 'MerchantController@phoneVerify');
    Route::get('merchant/logout', 'MerchantController@logout');
    Route::get('merchant/forget/password', 'MerchantController@passreset');
    Route::post('auth/merchant/password/reset', 'MerchantController@passfromreset');
    Route::get('/merchant/resetpassword/verify', 'MerchantController@resetpasswordverify');
    Route::get('resend/password-reset/code/{id}', 'MerchantController@resendPasswordcode');
    Route::post('auth/merchant/reset/password', 'MerchantController@saveResetPassword');
    Route::post('auth/merchant/single-servicer', 'MerchantController@singleservice');

    // Agent Operation
    Route::get('agent/login', 'AgentController@loginform');
    Route::post('auth/agent/login', 'AgentController@login');
    Route::get('agent/forget/password', 'AgentController@passreset');
    Route::post('auth/agent/password/reset', 'AgentController@passfromreset');
    Route::get('/agent/resetpassword/verify', 'AgentController@resetpasswordverify');
    Route::post('auth/agent/reset/password', 'AgentController@saveResetPassword');

    // Deliveryman Operation
    Route::get('deliveryman/login', 'DeliverymanController@loginform');
    Route::post('auth/deliveryman/login', 'DeliverymanController@login');
    Route::get('deliveryman/forget/password', 'DeliverymanController@passreset');
    Route::post('auth/deliveryman/password/reset', 'DeliverymanController@passfromreset');
    Route::get('/deliveryman/resetpassword/verify', 'DeliverymanController@resetpasswordverify');
    Route::post('auth/deliveryman/reset/password', 'DeliverymanController@saveResetPassword');
});

Route::group(['namespace' => 'FrontEnd', 'middleware' => ['agentauth']], function () {
    Route::get('/agent/dashboard', 'AgentController@dashboard');
    Route::get('agent/logout', 'AgentController@logout');
    Route::get('agent/parcels', 'AgentController@parcels');
    Route::get('agent/parcels-create', 'AgentController@parcelcreate');
    Route::post('agent/parcels-store', 'AgentController@parcelstore');
    Route::get('agent/parcel/{slug}', 'AgentController@parcelstatus');
    Route::get('agent/parcel/invoice/{id}', 'AgentController@invoice');
    Route::get('agent/pickup', 'AgentController@pickup');

    //payment
    Route::get('agent/todays-payment', 'AgentController@todaysPayment');
    Route::get('agent/delay-payment', 'AgentController@delayPayment');
    Route::post('agent/submit-payment', 'AgentController@SubmitPayment');

    Route::post('agent/deliveryman/asign', 'AgentController@delivermanasiagn');
    Route::post('agent/parcel/status-update', 'AgentController@statusupdate');
    Route::post('agent/pickup/deliveryman/asign', 'AgentController@pickupdeliverman');
    Route::post('agent/pickup/status-update', 'AgentController@pickupstatus');
    Route::post('agent/parcel/export', 'AgentController@export');
});

Route::group(['namespace' => 'FrontEnd', 'middleware' => ['deliverymanauth']], function () {
    Route::get('deliveryman/dashboard', 'DeliverymanController@dashboard');
    Route::get('deliveryman/logout', 'DeliverymanController@logout');
    Route::get('deliveryman/parcels', 'DeliverymanController@parcels');
    Route::get('deliveryman/parcel/{slug}', 'DeliverymanController@parcelstatus');
    Route::get('deliveryman/parcel/invoice/{id}', 'DeliverymanController@invoice');
    Route::post('deliveryman/parcel/status-update', 'DeliverymanController@statusupdate');
    Route::get('deliveryman/pickup', 'DeliverymanController@pickup');
    Route::post('deliveryman/pickup/status-update', 'AgentController@pickupstatus');
    Route::post('deliveryman/parcel/export', 'DeliverymanController@export');

    //payment
    Route::get('deliveryman/todays-payment', 'DeliverymanController@todaysPayment');
    Route::get('deliveryman/delay-payment', 'DeliverymanController@delayPayment');
    Route::post('deliveryman/submit-payment', 'DeliverymanController@SubmitPayment');

    Route::post('deliveryman/parcel/parcel-resend', 'DeliverymanController@parcel_resend');
    Route::post('deliveryman/parcel/parcel-verify', 'DeliverymanController@parcel_verify');

});

Route::group(['namespace' => 'FrontEnd', 'middleware' => ['merchantauth']], function () {
    // Merchant operation
    Route::get('merchant/dashboard', 'MerchantController@dashboard');
    Route::post('merchant/parcel/import', 'MerchantController@import');
    Route::post('merchant/parcel/export', 'MerchantController@export');
    Route::get('merchant/new-order/{slug}', 'MerchantController@parcelcreate');
    Route::get('merchant/pricing/{slug}', 'MerchantController@pricing');
    Route::get('merchant/payment/invoice-details/{id}', 'MerchantController@inovicedetails');
    Route::get('merchant/profile', 'MerchantController@profile');
    Route::get('merchant/profile/edit', 'MerchantController@profileEdit');
    Route::post('merchant/profile/edit', 'MerchantController@profileUpdate');
    Route::get('merchant/profile/settings', 'MerchantController@profileEdit');
    Route::get('merchant/stats', 'MerchantController@stats');
    Route::get('merchant/fraud-check', 'MerchantController@fraudcheck');
    Route::get('merchant/parcel/create', 'MerchantController@parcelcreate');
    Route::get('merchant/pickup', 'MerchantController@pickup');
    Route::get('merchant/support', 'MerchantController@support');
    Route::get('merchant/parcel/track', 'MerchantController@track');
    Route::get('merchant/parcel/invoice/{id}', 'MerchantController@invoice');
    // pickup request
    Route::post('merchant/pickup/request', 'MerchantController@pickuprequest');
    // parcel oparation
    Route::post('merchant/add/parcel', 'MerchantController@parcelstore');
    Route::get('merchant/parcels', 'MerchantController@parcels');
    Route::get('merchant/parcel/in-details/{id}', 'MerchantController@parceldetails');
    Route::get('merchant/parcel/edit/{id}', 'MerchantController@parceledit');
    Route::post('merchant/update/parcel', 'MerchantController@parcelupdate');
    Route::post('/merchant/parcel/track/', 'MerchantController@parceltrack');
    Route::get('merchant/get/payments', 'MerchantController@payments');
    // parcel slug
    Route::get('merchant/parcel/{slug}', 'MerchantController@parcelstatus');
    // password change routes
    Route::get('merchant/password/change', 'MerchantController@index');
    Route::post('auth/merchant/password/change', 'MerchantController@changepassword');
});

Route::group(['as' => 'superadmin.', 'prefix' => 'superadmin', 'namespace' => 'Superadmin', 'middleware' => ['auth', 'superadmin']], function () {
    // superadmin dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // user route
    Route::get('/user/add', 'UserController@add');
    Route::post('/user/save', 'UserController@save');
    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::post('/user/update', 'UserController@update');
    Route::get('/user/manage', 'UserController@manage');
    Route::post('/user/inactive', 'UserController@inactive');
    Route::post('/user/active', 'UserController@active');
    Route::post('/user/delete', 'UserController@destroy');
});

// Live Search
Route::get('search_data/{keyword}', 'search\liveSearchController@SearchData');
Route::get('search_data', 'search\liveSearchController@SearchWithoutData');
// Ajax Route
Route::get('/ajax-product-subcategory', 'editor\productController@getSubcategory');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'author']], function () {

// Transform from admin
    Route::post('merchant-payment/bulk-option', 'DashboardController@bulkpayment');

});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    // admin dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    // Route::post('merchant-payment/bulk-option', 'DashboardController@bulkpayment');
    // Nearest Zone Route
    Route::get('/nearestzone/add', 'NearestzoneController@add');
    Route::post('/nearestzone/save', 'NearestzoneController@store');
    Route::get('/nearestzone/manage', 'NearestzoneController@manage');
    Route::get('/nearestzone/edit/{id}', 'NearestzoneController@edit');
    Route::post('/nearestzone/update', 'NearestzoneController@update');
    Route::post('/nearestzone/inactive', 'NearestzoneController@inactive');
    Route::post('/nearestzone/active', 'NearestzoneController@active');
    Route::post('/nearestzone/delete', 'NearestzoneController@destroy');

    // Delivery Charge Route
    Route::get('/deliverycharge/add', 'DeliveryChargeController@add');
    Route::post('/deliverycharge/save', 'DeliveryChargeController@store');
    Route::get('/deliverycharge/manage', 'DeliveryChargeController@manage');
    Route::get('/deliverycharge/edit/{id}', 'DeliveryChargeController@edit');
    Route::post('/deliverycharge/update', 'DeliveryChargeController@update');
    Route::post('/deliverycharge/inactive', 'DeliveryChargeController@inactive');
    Route::post('/deliverycharge/active', 'DeliveryChargeController@active');
    Route::post('/deliverycharge/delete', 'DeliveryChargeController@destroy');

    // Cod Charge Route
    Route::get('codcharge/add', 'CodChargeController@add');
    Route::post('codcharge/save', 'CodChargeController@store');
    Route::get('codcharge/manage', 'CodChargeController@manage');
    Route::get('codcharge/edit/{id}', 'CodChargeController@edit');
    Route::post('codcharge/update', 'CodChargeController@update');
    Route::post('codcharge/inactive', 'CodChargeController@inactive');
    Route::post('codcharge/active', 'CodChargeController@active');
    Route::post('codcharge/delete', 'CodChargeController@destroy');

    // District route
    Route::get('/district/add', 'DistrictController@index');
    Route::post('/district/save', 'DistrictController@store');
    Route::get('/district/manage', 'DistrictController@manage');
    Route::get('/district/edit/{id}', 'DistrictController@edit');
    Route::post('/district/update', 'DistrictController@update');
    Route::post('/district/inactive', 'DistrictController@inactive');
    Route::post('/district/active', 'DistrictController@active');
    Route::post('/district/delete', 'DistrictController@destroy');

});

// Route::group(['as' => 'editor.', 'prefix' => 'editor', 'namespace' => 'Editor', 'middleware' => ['auth', 'admin']], function () {

//     Route::get('/parcel/edit/{id}', 'ParcelManageController@parceledit');

//     Route::post('/parcel/update', 'ParcelManageController@parcelupdate');
// });

Route::group(['as' => 'editor.', 'prefix' => 'editor', 'namespace' => 'Editor', 'middleware' => ['auth', 'author']], function () {
// Transfer from editor

    Route::get('parcel/all', 'ParcelManageController@allparcel');
    Route::get('parcel/{slug}', 'ParcelManageController@parcel');
    Route::post('/dliveryman-asign/bulk-option', 'ParcelManageController@bulkdeliverymanAssign');
    Route::get('/processing/parcel', 'ParcelManageController@processing');
    Route::post('agent/asign', 'ParcelManageController@agentasign');
    Route::post('deliveryman/asign', 'ParcelManageController@deliverymanasign');
    Route::post('/parcel/status-update', 'ParcelManageController@statusupdate');
    Route::get('/parcel/invoice/{id}', 'ParcelManageController@invoice');
    Route::post('pickupman/asign', 'ParcelManageController@pickupmanasign');

});

Route::group(['as' => 'editor.', 'prefix' => 'editor', 'namespace' => 'Editor', 'middleware' => ['auth', 'author']], function () {

    // Transform from editor

    Route::get('/new/parcel-create', 'ParcelManageController@create');

});

Route::group(['as' => 'editor.', 'prefix' => 'editor', 'namespace' => 'Editor', 'middleware' => ['auth', 'editor']], function () {
    // editor dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //expense category
    Route::get('/ec/index', 'ExpenseCategoryController@index')->name('ec.index');
    Route::post('/ec/store', 'ExpenseCategoryController@store')->name('ec.store');
    Route::get('/ec/edit/{id}', 'ExpenseCategoryController@edit')->name('ec.edit');
    Route::patch('/ec/update/{id}', 'ExpenseCategoryController@update')->name('ec.update');

    //expense
    Route::get('/e/index', 'ExpenseController@index')->name('e.index');
    Route::get('/e/create', 'ExpenseController@create')->name('e.create');
    Route::post('/e/store', 'ExpenseController@store')->name('e.store');
    Route::get('/e/edit/{id}', 'ExpenseController@edit')->name('e.edit');
    Route::patch('/e/update/{id}', 'ExpenseController@update')->name('e.update');
    Route::delete('/e/delete/{id}', 'ExpenseController@delete')->name('e.delete');

    //income
    Route::get('/e/income', 'ExpenseController@income')->name('e.income');

    //revenue
    Route::get('/e/revenue', 'ExpenseController@revenue')->name('e.revenue');

    // Delivery Man Route
    Route::get('deliveryman/add', 'DeliverymanManageController@add');
    Route::post('deliveryman/save', 'DeliverymanManageController@save');
    Route::get('deliveryman/edit/{id}', 'DeliverymanManageController@edit');
    Route::post('deliveryman/update', 'DeliverymanManageController@update');
    Route::get('deliveryman/manage', 'DeliverymanManageController@manage');
    Route::post('deliveryman/inactive', 'DeliverymanManageController@inactive');
    Route::post('deliveryman/active', 'DeliverymanManageController@active');
    Route::get('deliveryman/delete/{id}', 'DeliverymanManageController@destroy');
    Route::get('deliveryman/view/{id}', 'DeliverymanManageController@view');
    Route::post('deliveryman-payment/bulk-option', 'DeliverymanManageController@bulkpayment');
    Route::get('/deliveryman/payment/invoice/{id}', 'DeliverymanManageController@paymentinvoice');
    Route::get('/deliveryman/payment/invoice-details/{id}', 'DeliverymanManageController@inovicedetails');

    //parcel manage
    // Route::get('parcel/all', 'ParcelManageController@allparcel');
    // Route::get('parcel/{slug}', 'ParcelManageController@parcel');
    // Route::post('/dliveryman-asign/bulk-option', 'ParcelManageController@bulkdeliverymanAssign');
    // Route::get('/processing/parcel', 'ParcelManageController@processing');
    // Route::post('agent/asign', 'ParcelManageController@agentasign');
    // Route::post('deliveryman/asign', 'ParcelManageController@deliverymanasign');
    // Route::post('/parcel/status-update', 'ParcelManageController@statusupdate');
    // Route::get('/parcel/invoice/{id}', 'ParcelManageController@invoice');
    // Route::post('pickupman/asign', 'ParcelManageController@pickupmanasign');

    // parcel route here
    // Route::get('/new/parcel-create', 'ParcelManageController@create');
    Route::post('/parcel/store', 'ParcelManageController@parcelstore');

    Route::get('/parcel/edit/{id}', 'ParcelManageController@parceledit');
    Route::get('/parcel/delete/{id}', 'ParcelManageController@parceldelete');

    Route::post('/parcel/update', 'ParcelManageController@parcelupdate');

    Route::get('/parcel/parcel-verify_page', 'ParcelManageController@parcel_verify_page');

    Route::post('/parcel/parcel-resend', 'ParcelManageController@parcel_resend');
    Route::post('/parcel/parcel-verify', 'ParcelManageController@parcel_verify');

    //payment
    Route::get('/parcel/payment/todays-payment', 'ParcelManageController@todaysPayment');
    Route::get('/parcel/payment/old-payment', 'ParcelManageController@oldPayment');
    Route::get('/parcel/payment/merchant-payment', 'ParcelManageController@merchantPayment');
    Route::get('/merchant/payment/merchant-payment-details/{id}', 'ParcelManageController@merchantPaymentDetails')->name('merchantPaymentDetails');
    Route::post('/merchant/payment/submit-payment', 'ParcelManageController@merchantSubmitPayment');

    // parcel Manage
    Route::get('/new/pickup', 'PickupManageController@newpickup');
    Route::get('/pending/pickup', 'PickupManageController@pendingpickup');
    Route::get('/accepted/pickup', 'PickupManageController@acceptedpickup');
    Route::get('/cancelled/pickup', 'PickupManageController@cancelled');
    Route::post('pickup/agent/asign', 'PickupManageController@agentmanasign');
    Route::post('pickup/deliveryman/asign', 'PickupManageController@deliverymanasign');
    Route::post('/pickup/status-update', 'PickupManageController@statusupdate');
    //  ================ website oparation =====================

    // Logo route here
    Route::get('/logo/create', 'LogoController@create');
    Route::post('/logo/store', 'LogoController@store');
    Route::get('/logo/manage', 'LogoController@manage');
    Route::get('/logo/edit/{id}', 'LogoController@edit');
    Route::post('/logo/update', 'LogoController@update');
    Route::post('/logo/inactive', 'LogoController@inactive');
    Route::post('/logo/active', 'LogoController@active');
    Route::post('/logo/delete', 'LogoController@destroy');

    // Banner route here
    Route::get('/banner/create', 'BannerController@create');
    Route::post('/banner/store', 'BannerController@store');
    Route::get('/banner/manage', 'BannerController@manage');
    Route::get('/banner/edit/{id}', 'BannerController@edit');
    Route::post('/banner/update', 'BannerController@update');
    Route::post('/banner/inactive', 'BannerController@inactive');
    Route::post('/banner/active', 'BannerController@active');
    Route::post('/banner/delete', 'BannerController@destroy');

    // Service route here
    Route::get('/service/create', 'ServiceController@create');
    Route::post('/service/store', 'ServiceController@store');
    Route::get('/service/manage', 'ServiceController@manage');
    Route::get('/service/edit/{id}', 'ServiceController@edit');
    Route::post('/service/update', 'ServiceController@update');
    Route::post('/service/inactive', 'ServiceController@inactive');
    Route::post('/service/active', 'ServiceController@active');
    Route::post('/service/delete', 'ServiceController@destroy');

    // Feature Operation
    Route::get('/feature/create', 'FeatureController@create');
    Route::post('/feature/store', 'FeatureController@store');
    Route::get('/feature/manage', 'FeatureController@manage');
    Route::get('/feature/edit/{id}', 'FeatureController@edit');
    Route::post('/feature/update', 'FeatureController@update');
    Route::post('/feature/inactive', 'FeatureController@inactive');
    Route::post('/feature/active', 'FeatureController@active');
    Route::post('/feature/delete', 'FeatureController@destroy');

    // Price route here
    Route::get('price/create', 'PriceController@create');
    Route::post('price/store', 'PriceController@store');
    Route::get('price/manage', 'PriceController@manage');
    Route::get('price/edit/{id}', 'PriceController@edit');
    Route::post('price/update', 'PriceController@update');
    Route::post('price/inactive', 'PriceController@inactive');
    Route::post('price/active', 'PriceController@active');
    Route::post('price/delete', 'PriceController@destroy');

    // Blog route here
    Route::get('/blog/create', 'BlogController@create');
    Route::post('/blog/store', 'BlogController@store');
    Route::get('/blog/manage', 'BlogController@manage');
    Route::get('/blog/edit/{id}', 'BlogController@edit');
    Route::post('/blog/update', 'BlogController@update');
    Route::post('/blog/inactive', 'BlogController@inactive');
    Route::post('/blog/active', 'BlogController@active');
    Route::post('/blog/delete', 'BlogController@destroy');

    Route::get('/social-media/add', 'SocialController@index');
    Route::post('/social-media/save', 'SocialController@store');
    Route::get('/social-media/manage', 'SocialController@manage');
    Route::get('/social-media/edit/{id}', 'SocialController@edit');
    Route::post('/social-media/update', 'SocialController@update');
    Route::post('/social-media/unpublished', 'SocialController@unpublished');
    Route::post('/social-media/published', 'SocialController@published');
    Route::post('/social-media/delete', 'SocialController@destroy');

    // Partner route here
    Route::get('/partner/create', 'PartnerController@create');
    Route::post('/partner/store', 'PartnerController@store');
    Route::get('/partner/manage', 'PartnerController@manage');
    Route::get('/partner/edit/{id}', 'PartnerController@edit');
    Route::post('/partner/update', 'PartnerController@update');
    Route::post('/partner/inactive', 'PartnerController@inactive');
    Route::post('/partner/active', 'PartnerController@active');
    Route::post('/partner/delete', 'PartnerController@destroy');

    // About route here
    Route::get('/about/create', 'AboutController@create');
    Route::post('/about/store', 'AboutController@store');
    Route::get('/about/manage', 'AboutController@manage');
    Route::get('/about/edit/{id}', 'AboutController@edit');
    Route::post('/about/update', 'AboutController@update');
    Route::post('/about/inactive', 'AboutController@inactive');
    Route::post('/about/active', 'AboutController@active');
    Route::post('/about/delete', 'AboutController@destroy');

    Route::get('/clientfeedback/create', 'ClientfeedbackController@create');
    Route::post('/clientfeedback/store', 'ClientfeedbackController@store');
    Route::get('/clientfeedback/manage', 'ClientfeedbackController@manage');
    Route::get('/clientfeedback/edit/{id}', 'ClientfeedbackController@edit');
    Route::post('/clientfeedback/update', 'ClientfeedbackController@update');
    Route::post('/clientfeedback/inactive', 'ClientfeedbackController@inactive');
    Route::post('/clientfeedback/active', 'ClientfeedbackController@active');
    Route::post('/clientfeedback/delete', 'ClientfeedbackController@destroy');

    // career
    Route::get('career/create', 'CareerController@create');
    Route::post('career/store', 'CareerController@store');
    Route::get('career/manage', 'CareerController@manage');
    Route::get('career/edit/{id}', 'CareerController@edit');
    Route::post('career/update', 'CareerController@update');
    Route::post('career/inactive', 'CareerController@inactive');
    Route::post('career/active', 'CareerController@active');
    Route::post('career/delete', 'CareerController@destroy');

    // notice
    Route::get('notice/create', 'NoticeController@create');
    Route::post('notice/store', 'NoticeController@store');
    Route::get('notice/manage', 'NoticeController@manage');
    Route::get('notice/edit/{id}', 'NoticeController@edit');
    Route::post('notice/update', 'NoticeController@update');
    Route::post('notice/inactive', 'NoticeController@inactive');
    Route::post('notice/active', 'NoticeController@active');
    Route::post('notice/delete', 'NoticeController@destroy');

    // Gallery
    Route::get('gallery/create', 'GalleryController@create');
    Route::post('gallery/store', 'GalleryController@store');
    Route::get('gallery/manage', 'GalleryController@manage');
    Route::get('gallery/edit/{id}', 'GalleryController@edit');
    Route::post('gallery/update', 'GalleryController@update');
    Route::post('gallery/inactive', 'GalleryController@inactive');
    Route::post('gallery/active', 'GalleryController@active');
    Route::post('gallery/delete', 'GalleryController@destroy');

    // Note
    Route::get('note/create', 'NoteController@create');
    Route::post('note/store', 'NoteController@store');
    Route::get('note/manage', 'NoteController@manage');
    Route::get('note/edit/{id}', 'NoteController@edit');
    Route::post('note/update', 'NoteController@update');
    Route::post('note/inactive', 'NoteController@inactive');
    Route::post('note/active', 'NoteController@active');
    Route::post('note/delete', 'NoteController@destroy');

    //pages
    Route::get('/pages', 'PageController@pageList')->name('pageList');
    Route::get('/create-pages', 'PageController@pageCreate')->name('pageCreate');
    Route::post('/store-pages', 'PageController@pageStore')->name('pageStore');
    Route::get('/edit-pages/{page}', 'PageController@pageEdit')->name('pageEdit');
    Route::put('/update-pages/{page}', 'PageController@pageUpdate')->name('pageUpdate');
    Route::delete('/delete-pages/{page}', 'PageController@pageDelete')->name('pageDelete');
    Route::post('/active-pages/{page}', 'PageController@pageActive')->name('pageActive');
    Route::post('/inactive-pages/{page}', 'PageController@pageInactive')->name('pageInactive');
});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth', 'author']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // merchant operation
    Route::get('/merchant-request/manage', 'MerchantOperationController@merchantrequest');
    Route::get('/merchant/manage', 'MerchantOperationController@manage');
    Route::get('/merchant/edit/{id}', 'MerchantOperationController@profileedit');
    Route::get('/merchant/delete/{id}', 'MerchantOperationController@delete');
    Route::post('merchant/profile/edit', 'MerchantOperationController@profileUpdate');
    Route::post('merchant/inactive', 'MerchantOperationController@inactive');
    Route::post('merchant/active', 'MerchantOperationController@active');
    Route::get('merchant/view/{id}', 'MerchantOperationController@view');
    Route::post('merchant/get/payment', 'MerchantOperationController@payment');
    Route::get('/merchant/payment/invoice/{id}', 'MerchantOperationController@paymentinvoice');
    Route::get('/merchant/payment/invoice-details/{id}', 'MerchantOperationController@inovicedetails');
    Route::post('merchant/charge-setup', 'MerchantOperationController@chargesetup');

    // Department Route
    Route::get('department/add', 'DepartmentController@add');
    Route::post('department/save', 'DepartmentController@store');
    Route::get('department/manage', 'DepartmentController@manage');
    Route::get('department/edit/{id}', 'DepartmentController@edit');
    Route::post('department/update', 'DepartmentController@update');
    Route::post('department/inactive', 'DepartmentController@inactive');
    Route::post('department/active', 'DepartmentController@active');
    Route::post('department/delete', 'DepartmentController@destroy');

    // Employee Route
    Route::get('/employee/add', 'EmployeeController@add');
    Route::post('/employee/save', 'EmployeeController@save');
    Route::get('/employee/edit/{id}', 'EmployeeController@edit');
    Route::post('/employee/update', 'EmployeeController@update');
    Route::get('/employee/manage', 'EmployeeController@manage');
    Route::post('/employee/inactive', 'EmployeeController@inactive');
    Route::post('/employee/active', 'EmployeeController@active');
    Route::post('/employee/delete', 'EmployeeController@destroy');

    // Agent Manage Route
    Route::get('agent/add', 'AgentManageController@add');
    Route::post('agent/save', 'AgentManageController@save');
    Route::get('agent/edit/{id}', 'AgentManageController@edit');
    Route::post('agent/update', 'AgentManageController@update');
    Route::get('agent/manage', 'AgentManageController@manage');
    Route::post('agent/inactive', 'AgentManageController@inactive');
    Route::post('agent/active', 'AgentManageController@active');
    Route::get('agent/view/{id}', 'AgentManageController@view');

    Route::post('agent-payment/bulk-option', 'AgentManageController@bulkpayment');
    Route::post('agent/delete', 'AgentManageController@destroy');
});

// other route
Route::group(['middleware' => ['auth']], function () {
    Route::get('password/change', 'ChangePassController@index');
    Route::post('password/updated', 'ChangePassController@updated');
});
