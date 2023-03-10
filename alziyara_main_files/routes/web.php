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

//Route::get('/link', function () {
//    print_r(Artisan::call('cache:clear'));
//    var_dump(Artisan::call('storage:link'));
//    die;
//});
Route::get('/link', function() {
    $exitCode = Artisan::call('storage:link', [] );
    echo $exitCode; // 0 exit code for no errors.
    die;
});

Route::get('/clear-all', function() {
    //$exitCodeConfig = Artisan::call('config:cache');
    $exitCodeCache = Artisan::call('cache:clear');
    $exitCodeUpdate = Artisan::call('optimize:clear');
    $exitCodeView = Artisan::call('view:clear');
    //Artisan::call('link:storage');
    // $exitCodePermissionCache = Artisan::call('permission:cache-reset');
    //$exitCodePermissionCache = Artisan::call('cache:forget laravelspatie.permission.cache');

    return '<div style="text-align:center;">
                <h1 style="text-align:center;">Cache and Config and permission cache are cleared.</h1>
                <h4><a href="/">Go to home</a></h4>
            </div>
            ';
});

Route::get('testing','WebsiteController@testing')->name('testing');
Route::get('contact_us','WebsiteController@contactUs')->name('contact_us');
Route::post('contact_request','WebsiteController@contactRequest')->name('contact_request');
Route::post('askAQuestion','WebsiteController@askAQuestion')->name('ask_A_Question');
Route::get('askAQuestion','WebsiteController@askAQuestion')->name('ask_A_Question');

Route::get('/','WebsiteController@index')->name('index');
Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','PackagesAdmin','HotelsAdmin','TransportAdmin','guestpassbookingsd','SuperAdmin','GuestsPassAdmin','customer']], function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard.index');
//    });
    Route::get('/dashboard', 'WebsiteController@dashboardIndex')->name('dashboard');
    Route::get('account-settings','UsersController@getSettings');
    Route::post('account-settings','UsersController@saveSettings');

    
});



    Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','GuestsPassAdmin']], function () {
    Route::get('/addguestspasses','guestpasscontroller@addguests')->name('addguestspass');
    Route::post('/createguestspasses','guestpasscontroller@createguests')->name('createguestspass');
    Route::get('/myguestspasses','guestpasscontroller@myallguestspass')->name('myguestspass');
    Route::get('/guestphotopassremove/{id}','guestpasscontroller@removeguestpassphoto');
    Route::get('/guestprogramdetailpassremove/{id}','guestpasscontroller@removeguestpassprogramdetail');
	Route::get('/guestpassorders','guestpasscontroller@guestpassreservation')->name('guestpassordersreservations');
	Route::get('/guestpassstatus/{id}/{status}','guestpasscontroller@guestpassstatusupdate');
	Route::get('/guestpassreservation/{id}','guestpasscontroller@guestpassreserveone')->name('guestsreverses');
	Route::get('/guestpassbooking','guestpasscontroller@myguestpassbooking')->name('guestpassbooking');
});
    Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','SuperAdmin','GuestsPassAdmin']], function () {
    Route::get('/updatemyguestspasses/{gp}','guestpasscontroller@myeditguestspass')->name('guestspassupdate');
    Route::post('/myupdateguestspasses','guestpasscontroller@updateguests')->name('updateguestspass');
});
    Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','SuperAdmin','HotelsAdmin']], function () {
    Route::get('/edithotel/{id}','PropertyController@edithotel')->name('edithotel');
    Route::get('/myrooms/{id?}','PropertyController@myallroom')->name('myroom');
    Route::get('/editrooms/{id}','PropertyController@editroom')->name('myeditrooms');
    Route::post('/updaterooms','PropertyController@myupdaterooms')->name('myupdaterooms');
});
// Route::get('/guestphotostoretest','guestpasscontroller@testnewstoredprocedure');


Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','SuperAdmin']], function () { 


    Route::get('/allguestpasses','SuperAdminController@allguestpasses')->name('allguestspass');

	Route::get('/adminguestpassstatus/{id}/{status}','SuperAdminController@guestpassstatusupdate');

    Route::get('/guestshowpass/{id}','SuperAdminController@showguestpass')->name('guestshowpass');

	Route::get('/allguestpassorders','SuperAdminController@allguestpassreservation')->name('myallguestpassreservation');

    Route::get('/guestpasshomepagestatus/{id}/{status}','SuperAdminController@guestpasshomepagestatusupdate');

	Route::get('/guestpassreservationsd/{id}','SuperAdminController@supadguestpassreserveone')->name('guestsreversesadmin');

	Route::get('/allcity','SuperAdminController@mycity')->name('cities');

	Route::get('/addcity','SuperAdminController@createcity')->name('createmycity');

	Route::post('/savecity','SuperAdminController@citysave')->name('createsavecity');

	Route::get('/mycity/{id}','SuperAdminController@city')->name('ourcity');

	Route::post('/editcity','SuperAdminController@updatesave')->name('updatecity');

	Route::get('/citystatus/{id}/{status}','SuperAdminController@mycitystatus');

	Route::get('/guestpassbookingsd','SuperAdminController@myguestpassbookingsd')->name('guestpassbookingsd');

	Route::get('/allusers','SuperAdminController@allusers')->name('allusers');

	Route::get('/service-provider-request','SuperAdminController@serviceProviderRequests')->name('service-provider-request');

	Route::get('/userstatus/{id}/{status}','SuperAdminController@myuserstatus');

	Route::get('/allproperties','SuperAdminController@allproperties')->name('allproperty');

	Route::get('/adminpropertystatus/{id}/{status}','SuperAdminController@mypropertystatus');

	Route::get('/propertyshow/{id}','SuperAdminController@mypropertyshow')->name('propertyshow');

	Route::get('/allroomorders','SuperAdminController@allroomreservation')->name('myallroomreservation');

	Route::get('/roomreservationsd/{id}','SuperAdminController@roomreserveone')->name('roomreservesadmin');

	Route::get('/roombookingsd','SuperAdminController@myroombookingsd')->name('roombookingsd');

	Route::get('/alltransportorders','SuperAdminController@alltransportreservation')->name('myalltransportreservation');

	Route::get('/transportreservationsd/{id}','SuperAdminController@transportreserveone')->name('transportreservesadmin');

	Route::get('/transportbookingsd','SuperAdminController@mytransportbookingsd')->name('transportbookingsd');
	
	Route::get('/packagebookingsd','SuperAdminController@mypackagebookingsd')->name('packagebookingsd');

	Route::get('/allguideorders','SuperAdminController@allguidereservation')->name('myallguidereservation');

	Route::get('/guidereservationsd/{id}','SuperAdminController@guidereserveone')->name('guidereservesadmin');

        Route::get('/guidebookingsd','SuperAdminController@myguidebookingsd')->name('guidebookingsd');

	Route::get('user/edit/{id}','UsersController@edit');
    Route::post('user/edit/{id}','UsersController@update');

	Route::get('packages_mypayment_status/{id?}/{status?}/{value?}','SuperAdminController@packagesPaymentStatus')->name('packages_payment_status');

	Route::get('room_mypayment_status/{id?}/{status?}/{value?}','SuperAdminController@roomPaymentStatus')->name('room_payment_status');

	Route::get('transport_mypayment_status/{id?}/{status?}/{value?}','SuperAdminController@transportPaymentStatus')->name('transport_payment_status');

	Route::get('guide_mypayment_status/{id?}/{status?}/{value?}','SuperAdminController@guidePaymentStatus')->name('guide_payment_status');

	Route::get('guestpass_mypayment_status/{id?}/{status?}/{value?}','SuperAdminController@guestpassPaymentStatus')->name('guestpass_payment_status');

	Route::get('/allrefundrequests','SuperAdminController@refundrequests')->name('refundrequest');

});

Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','HotelsAdmin']], function () {

    Route::get('/addhotel','PropertyController@addproperty')->name('createhotel');

	Route::post('/savehotel','PropertyController@saveproperty')->name('savehotel');

    Route::get('/addroom/{id?}','PropertyController@createroom')->name('createroom');

	Route::post('/saveroom','PropertyController@saveroom')->name('saveroom');

	Route::get('/myhotels','PropertyController@myallproperty')->name('myhotel');

	Route::get('/propertystatus/{id}/{status}','PropertyController@mypropertystatus');

	Route::get('/roomstatus/{id}/{status}','PropertyController@myroomstatus');

	Route::get('/roomorders','PropertyController@roomreservation')->name('roomordersreservations');

	Route::get('/roomreservation/{id}','PropertyController@roomreserveone')->name('roomreverses');

	Route::get('/roombooking','PropertyController@myroombooking')->name('roombooking');

});

Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','SuperAdmin','TransportAdmin']], function () {

    Route::resource('transportation/transportation', 'Transportation\\TransportationController');

    Route::get('/alltransport','TransportController@alltransportoption')->name('alltransportoption');

    Route::get('/addtransport','TransportController@alltransportoption')->name('addtransport');

	Route::get('/transportorders','Transportation\\TransportationController@transportreservation')->name('transportordersreservations');

	Route::get('/transportreservation/{id}','Transportation\\TransportationController@transportreserveone')->name('transportreverses');

	Route::get('/transportbooking','Transportation\\TransportationController@mytransportbooking')->name('transportbooking');

});

Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','SuperAdmin','GuideAdmin']], function () {

    Route::resource('guid/guid', 'Guid\\GuidController');

    // Route::get('/alltransport','TransportController@alltransportoption')->name('alltransportoption');

    // Route::get('/addtransport','TransportController@alltransportoption')->name('addtransport');

	Route::get('/guideorders','GuideController@guidereservation')->name('guideordersreservations');

	Route::get('/guidereservation/{id}','GuideController@guidereserveone')->name('guidereverses');

	Route::get('/guidebooking','GuideController@myguidebooking')->name('guidebooking');
});

Route::group(['middleware' => ['auth', 'roles'],'roles' => ['admin','user','customer']], function () {

    // Route::get('/alltransport','TransportController@alltransportoption')->name('alltransportoption');

    // Route::get('/addtransport','TransportController@alltransportoption')->name('addtransport');

});

//Route::group(['middleware' => ['auth', 'roles'],'roles' => ['customer']], function () {
//    Route::get('checkout','WebsiteController@checkout')->name('checkout');
//});
Route::group(['middleware' => ['auth', 'roles'],'roles' => 'admin'], function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard.index');
//    });
    Route::get('index2', function (){
        return view('dashboard.index2');
    });
    Route::get('index3', function (){
        return view('dashboard.index3');
    });
    Route::get('index4', function (){
        return view('ecommerce.index4');
    });
    Route::get('products', function (){
        return view('ecommerce.products');
    });
    Route::get('product-detail', function (){
        return view('ecommerce.product-detail');
    });
    Route::get('product-edit', function (){
        return view('ecommerce.product-edit');
    });
    Route::get('product-orders', function (){
        return view('ecommerce.product-orders');
    });
    Route::get('product-cart', function (){
        return view('ecommerce.product-cart');
    });
    Route::get('product-checkout', function (){
        return view('ecommerce.product-checkout');
    });
    Route::get('panels-wells', function (){
        return view('ui-elements.panels-wells');
    });
    Route::get('panel-ui-block', function (){
        return view('ui-elements.panel-ui-block');
    });
    Route::get('portlet-draggable', function (){
        return view('ui-elements.portlet-draggable');
    });
    Route::get('buttons', function (){
        return view('ui-elements.buttons');
    });
    Route::get('tabs', function (){
        return view('ui-elements.tabs');
    });
    Route::get('modals', function (){
        return view('ui-elements.modals');
    });
    Route::get('progressbars', function (){
        return view('ui-elements.progressbars');
    });
    Route::get('notification', function (){
        return view('ui-elements.notification');
    });
    Route::get('carousel', function (){
        return view('ui-elements.carousel');
    });
    Route::get('user-cards', function (){
        return view('ui-elements.user-cards');
    });
    Route::get('timeline', function (){
        return view('ui-elements.timeline');
    });
    Route::get('timeline-horizontal', function (){
        return view('ui-elements.timeline-horizontal');
    });
    Route::get('range-slider', function (){
        return view('ui-elements.range-slider');
    });
    Route::get('ribbons', function (){
        return view('ui-elements.ribbons');
    });
    Route::get('steps', function (){
        return view('ui-elements.steps');
    });
    Route::get('session-idle-timeout', function (){
        return view('ui-elements.session-idle-timeout');
    });
    Route::get('session-timeout', function (){
        return view('ui-elements.session-timeout');
    });
    Route::get('bootstrap-ui', function (){
        return view('ui-elements.bootstrap');
    });
    Route::get('starter-page', function (){
        return view('pages.starter-page');
    });
    Route::get('blank', function (){
        return view('pages.blank');
    });
    Route::get('blank', function (){
        return view('pages.blank');
    });
    Route::get('search-result', function (){
        return view('pages.search-result');
    });
    Route::get('custom-scroll', function (){
        return view('pages.custom-scroll');
    });
    Route::get('lock-screen', function (){
        return view('pages.lock-screen');
    });
    Route::get('recoverpw', function (){
        return view('pages.recoverpw');
    });
    Route::get('animation', function (){
        return view('pages.animation');
    });
    Route::get('profile', function (){
        return view('pages.profile');
    });
    Route::get('invoice', function (){
        return view('pages.invoice');
    });
    Route::get('gallery', function (){
        return view('pages.gallery');
    });
    Route::get('pricing', function (){
        return view('pages.pricing');
    });
    Route::get('400', function (){
        return view('pages.400');
    });
    Route::get('403', function (){
        return view('pages.403');
    });
    Route::get('404', function (){
        return view('pages.404');
    });
    Route::get('500', function (){
        return view('pages.500');
    });
    Route::get('503', function (){
        return view('pages.503');
    });
    Route::get('form-basic', function (){
        return view('forms.form-basic');
    });
    Route::get('form-layout', function (){
        return view('forms.form-layout');
    });
    Route::get('icheck-control', function (){
        return view('forms.icheck-control');
    });
    Route::get('form-advanced', function (){
        return view('forms.form-advanced');
    });
    Route::get('form-upload', function (){
        return view('forms.form-upload');
    });
    Route::get('form-dropzone', function (){
        return view('forms.form-dropzone');
    });
    Route::get('form-pickers', function (){
        return view('forms.form-pickers');
    });
    Route::get('basic-table', function (){
        return view('tables.basic-table');
    });
    Route::get('table-layouts', function (){
        return view('tables.table-layouts');
    });
    Route::get('data-table', function (){
        return view('tables.data-table');
    });
    Route::get('bootstrap-tables', function (){
        return view('tables.bootstrap-tables');
    });
    Route::get('responsive-tables', function (){
        return view('tables.responsive-tables');
    });
    Route::get('editable-tables', function (){
        return view('tables.editable-tables');
    });
    Route::get('inbox', function (){
        return view('inbox.inbox');
    });
    Route::get('inbox-detail', function (){
        return view('inbox.inbox-detail');
    });
    Route::get('compose', function (){
        return view('inbox.compose');
    });
    Route::get('contact', function (){
        return view('inbox.contact');
    });
    Route::get('contact-detail', function (){
        return view('inbox.contact-detail');
    });
    Route::get('calendar', function (){
        return view('extra.calendar');
    });
    Route::get('widgets', function (){
        return view('extra.widgets');
    });
    Route::get('morris-chart', function (){
        return view('charts.morris-chart');
    });
    Route::get('peity-chart', function (){
        return view('charts.peity-chart');
    });
    Route::get('knob-chart', function (){
        return view('charts.knob-chart');
    });
    Route::get('sparkline-chart', function (){
        return view('charts.sparkline-chart');
    });
    Route::get('simple-line', function (){
        return view('icons.simple-line');
    });
    Route::get('fontawesome', function (){
        return view('icons.fontawesome');
    });
    Route::get('map-google', function (){
        return view('maps.map-google');
    });
    Route::get('map-vector', function (){
        return view('maps.map-vector');
    });

    #Permission management
    Route::get('permission-management','PermissionController@getIndex');
    Route::get('permission/create','PermissionController@create');
    Route::post('permission/create','PermissionController@save');
    Route::get('permission/delete/{id}','PermissionController@delete');
    Route::get('permission/edit/{id}','PermissionController@edit');
    Route::post('permission/edit/{id}','PermissionController@update');

    #Role management
    Route::get('role-management','RoleController@getIndex');
    Route::get('role/create','RoleController@create');
    Route::post('role/create','RoleController@save');
    Route::get('role/delete/{id}','RoleController@delete');
    Route::get('role/edit/{id}','RoleController@edit');
    Route::post('role/edit/{id}','RoleController@update');

    #CRUD Generator
    Route::get('/crud-generator', ['uses' => 'ProcessController@getGenerator']);
    Route::post('/crud-generator', ['uses' => 'ProcessController@postGenerator']);

    # Activity log
    Route::get('activity-log','LogViewerController@getActivityLog');
    Route::get('activity-log/data', 'LogViewerController@activityLogData')->name('activity-log.data');

    #User Management routes
    Route::get('users','UsersController@getIndex');
    Route::get('user/create','UsersController@create');
    Route::post('user/create','UsersController@save');
    // Route::get('user/edit/{id}','UsersController@edit');
    // Route::post('user/edit/{id}','UsersController@update');
    Route::get('user/delete/{id}','UsersController@delete');
    Route::get('user/deleted/','UsersController@getDeletedUsers');
    Route::get('user/restore/{id}','UsersController@restoreUser');
});

//Log Viewer
Route::get('log-viewers', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index')->name('log-viewers');
Route::get('log-viewers/logs', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs')->name('log-viewers.logs');
Route::delete('log-viewers/logs/delete', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@delete')->name('log-viewers.logs.delete');
Route::get('log-viewers/logs/{date}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@show')->name('log-viewers.logs.show');
Route::get('log-viewers/logs/{date}/download', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@download')->name('log-viewers.logs.download');
Route::get('log-viewers/logs/{date}/{level}', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@showByLevel')->name('log-viewers.logs.filter');
Route::get('log-viewers/logs/{date}/{level}/search', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@search')->name('log-viewers.logs.search');
Route::get('log-viewers/logcheck', '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@logCheck')->name('log-viewers.logcheck');

Route::get('auth/{provider}/','Auth\SocialLoginController@redirectToProvider');
Route::get('{provider}/callback','Auth\SocialLoginController@handleProviderCallback');
Route::get('logout','Auth\LoginController@logout');
// Auth::routes();




Route::get('sfmhome','sfmintControllers\sfmmainController@index');
Route::get('about','sfmintControllers\sfmmainController@about');
Route::get('sfmcoming','sfmintControllers\sfmmainController@comingsoon');
Route::get('sfmfundraising','sfmintControllers\sfmmainController@fundraising');
Route::get('sfmgallery','sfmintControllers\sfmmainController@gallery');
Route::get('sfmgame','sfmintControllers\sfmmainController@game');
Route::get('sfmshop','sfmintControllers\sfmmainController@shop');
Route::get('sfmvideos','sfmintControllers\sfmmainController@videos');
Route::get('sfmtshirtcustom','sfmintControllers\sfmmainController@tshirtcustom');

Route::get('home','WebsiteController@index')->name('index');
Route::get('hotels','WebsiteController@myhotels')->name('hotels');
Route::get('hotels-sorting/{sort_type?}','WebsiteController@hotelsSorting')->name('hotels-sorting');
Route::get('hotels-sorting-with-city/{sort_type?}/{city_name?}','WebsiteController@hotelsSortingWithCity')->name('hotels-sorting-with-city');

Route::get('hotelsdetails/{id?}/{name?}','WebsiteController@myhotelsdetails')->name('hotelsdetails');

Route::get('mybooking','WebsiteController@oldbooking')->name('mybook');
Route::get('mybookingitem/{id}','WebsiteController@mybookingsingleitem')->name('mybookingsingleitem');
Route::post('checkoutauth','WebsiteController@checkoutwithauth')->name('mycheckoutauth');
Route::get('packagesdeals','WebsiteController@mypackages')->name('packages');
Route::get('packagesdetail/{id?}/{name?}','WebsiteController@mypackagedetail')->name('packagedetail');
Route::get('visa','WebsiteController@myvisa')->name('visa');
Route::get('flights','WebsiteController@myflight')->name('flight');
Route::get('guestspasses','WebsiteController@myguestspasses')->name('guestspasses');
Route::get('guestspassesbycity/{cityName}','WebsiteController@guestsPassesByCity')->name('guestspassesbycity');
Route::get('guestdetails/{id?}/{name?}','WebsiteController@myguestsdetails')->name('guestsdetails');
Route::get('Transportation','WebsiteController@mytranspotation')->name('Transport');
Route::get('transportdetails/{id?}/{name?}','WebsiteController@mytranspotationdetails')->name('Transportdetails');
Route::get('transportation-by-type/{id?}','WebsiteController@transportationByType')->name('transportation-by-type');
Route::post('add-property-review','WebsiteController@addPropertyReview')->name('add-property-review');




Route::get('cart','WebsiteController@cart')->name('cart');
Route::get('aboutus','WebsiteController@aboutus')->name('aboutus');
Route::get('privacypolicy','WebsiteController@privacypolicy')->name('privacypolicy');
Route::get('terms-and-conditions','WebsiteController@termsAndConditions')->name('terms-and-conditions');
Route::get('faq','WebsiteController@faq')->name('faq');

Route::post('addtocart','WebsiteController@addToCart')->name('addtocart');

Route::get('sqlconnect','WebsiteController@sqlconnect');

Route::post('registermyuser','WebsiteController@registeruser')->name('registeruser');

//Route::post('searchguestpass','WebsiteController@searchGuestpass')->name('searchguestpass');
//Route::get('searchguestpass/{city?}/{total_guests?}/{adults?}/{childs?}/{infants?}','WebsiteController@searchGuestpass')->name('searchguestpass');
Route::get('searchguestpass/{params?}','WebsiteController@searchGuestpass')->name('searchguestpass');
Route::get('search-hotels/{params?}','WebsiteController@searchHotels')->name('search-hotels');

Route::post('add-guest-pass-review','WebsiteController@addGuestPassReview')->name('add-guest-pass-review');
Route::post('add-transportation-review','WebsiteController@addTransportationReview')->name('add-transportation-review');
//Auth::routes(['verify' => true]);
Auth::routes();


//Route::post('/registration-Resend-Mail','WebsiteController@registrationResendMail')->name('registration-Resend-Mail');
Route::get('registration-Resend-Mail','WebsiteController@registrationResendMail')->name('registration-Resend-Mail');


Route::post('registermyusersignup','WebsiteController@mysignup')->name('usersignup');
Route::get('/emailverify/{emailverifytoken}','WebsiteController@emailverification');
//Route::resource('propertyFavorite/property-favorite/', 'PropertyFavorite\\PropertyFavoriteController');
Route::get('add-favorite-property/{PropertyID?}/{CategoryID?}','WebsiteController@addFavoriteProperty')->name('add-favorite-property');
Route::get('remove-favorite-property/{PropertyID?}/{CategoryID?}','WebsiteController@removeFavoriteProperty')->name('remove-favorite-property');
Route::get('view-favorites','WebsiteController@viewFavorites')->name('view-favorites');

Route::resource('search/search', 'Search\\SearchController');
Route::resource('manageSetting/manage-setting', 'ManageSetting\\ManageSettingController');
Route::resource('packageDealType/package-deal-type', 'PackageDealType\\PackageDealTypeController');
Route::get('get-transportation-route-to/{name?}','WebsiteController@getTransportationRouteTo')->name('get-transportation-route-to');
Route::get('search-transportation/{params?}','WebsiteController@searchTransportation')->name('search-transportation');

//Update Package Status
Route::get('update_package_status/{PackageDealsID?}/{status?}','WebsiteController@updatePackageStatus')->name('update_package_status');

//Search Package Deals
Route::get('search_package_deals/{id?}','WebsiteController@searchPackageDeals')->name('search_package_deals');

Route::get('transportation-sorting/{sort_type?}','WebsiteController@transportationSorting')->name('transportation-sorting');
Route::get('searched-transportation-sorting/{sort_type?}/{searched_transportation_id?}/{type?}','WebsiteController@searchedTransportationSorting')->name('searched-transportation-sorting');
Route::get('transportation-sorting-with-type/{sort_type?}/{TransportationTypeID?}','WebsiteController@transportationSortingWithType')->name('transportation-sorting-with-type');

Route::post('update-transportation','Transportation\\TransportationController@update')->name('update-transportation');
Route::get('transport-image-remove/{id?}','Transportation\\TransportationController@transportImageRemove')->name('transport-image-remove');

// Write A review for packages
Route::post('add-package-review','WebsiteController@addpackageReview')->name('add-package-review');
Route::resource('transportRoute/transport-route', 'TransportRoute\\TransportRouteController');
Route::resource('transportType/transport-type', 'TransportType\\TransportTypeController');
Route::resource('transportFeature/transport-feature', 'TransportFeature\\TransportFeatureController');
Route::resource('roomsFeatureList/rooms-feature-list', 'RoomsFeatureList\\RoomsFeatureListController');


//Package Deals Sorting
Route::get('package-sorting-with-city/{sort_type?}/{searchPackageName?}','WebsiteController@packageSortingWithCity')->name('package-sorting-with-city');
Route::get('package-sorting/{sort_type?}','WebsiteController@packageSorting')->name('package-sorting');
Route::get('packages-by-type/{id?}','WebsiteController@packageDealsByType')->name('packgae_deals_by_city');
Route::get('package-sorting-with-type/{sort_type?}/{packageDealsTypeID?}','WebsiteController@packageSortingWithType')->name('package-sorting-with-type');
//Package Deals Calendar for Packages Admin
Route::get('my_package_booking_calendar','WebsiteController@myPackageBookingCalendar')->name('my_package_booking_calendar');


Route::resource('guideCity/guide-city', 'GuideCity\\GuideCityController');
Route::resource('guideLanguage/guide-language', 'GuideLanguage\\GuideLanguageController');
Route::get('guide','WebsiteController@myguide')->name('guide');
Route::get('guide-details/{id?}/{name?}','WebsiteController@guideDetails')->name('guide-details');
Route::post('add-guide-review','WebsiteController@addGuideReview')->name('add-guide-review');
Route::get('search-guide/{params?}','WebsiteController@searchGuide')->name('search-guide');
Route::get('guide-by-language/{language?}','WebsiteController@guideByLanguage')->name('guide-by-language');
Route::get('guide-sorting/{sort_type?}','WebsiteController@guideSorting')->name('guide-sorting');
Route::get('searched-guide-sorting/{sort_type?}/{language?}/{city?}/{total_guests?}','WebsiteController@searchedGuideSorting')->name('searched-guide-sorting');
Route::get('guide-sorting-with-language/{sort_type?}/{language?}','WebsiteController@guideSortingWithLanguage')->name('transportation-sorting-with-language');
Route::post('update-guide','Guid\\GuidController@update')->name('update-guide');
Route::get('guide-image-remove/{id?}','Guid\\GuidController@guideImageRemove')->name('guide-image-remove');

//Change Reservation Status
Route::get('packages_reservation_status/{id?}/{status?}/{value?}','WebsiteController@packagesReservationStatus')->name('packages_reservation_status');
Route::get('guestpass_reservation_status/{id?}/{status?}/{value?}','WebsiteController@guestpassReservationStatus')->name('guestpass_reservation_status');
Route::get('hotels_reservation_status/{id?}/{status?}/{value?}','WebsiteController@hotelsReservationStatus')->name('hotels_reservation_status');
Route::get('guide_reservation_status/{id?}/{status?}/{value?}','WebsiteController@guideReservationStatus')->name('guide_reservation_status');
Route::get('transport_reservation_status/{id?}/{status?}/{value?}','WebsiteController@transportReservationStatus')->name('transport_reservation_status');


//Search Reservations by date
Route::post('search_package_by_date','WebsiteController@searchPackageByDate')->name('search_package_by_date');
Route::post('search_guide_by_date','WebsiteController@searchGuideByDate')->name('search_guide_by_date');
Route::post('search_transport_by_date','WebsiteController@searchTransportByDate')->name('search_transport_by_date');
Route::post('search_room_by_date','WebsiteController@searchRoomByDate')->name('search_room_by_date');
Route::post('search_guestpass_by_date','WebsiteController@searchGuestpassByDate')->name('search_guestpass_by_date');

//Search Refund Request
Route::post('search_refund_request_by_date','WebsiteController@searchRefundRequestByDate')->name('search_refund_request_by_date');

//Invoice blades
Route::get('package_deals_invoice/{id?}','WebsiteController@packageDealsInvoice')->name('package_deals_invoice');
Route::get('guide_invoice/{id?}','WebsiteController@guideInvoice')->name('guide_invoice');
    Route::get('transport_invoice/{id?}','WebsiteController@transportInvoice')->name('transport_invoice');
Route::get('guestpass_invoice/{id?}','WebsiteController@guestpassInvoice')->name('guestpass_invoice');
Route::get('room_invoice/{id?}','WebsiteController@roomInvoice')->name('room_invoice');


//CustomerInvoice

Route::get('customer_package_deals_invoice/{id?}','WebsiteController@customerpackageDealsInvoice')->name('customer_package_deals_invoice');
Route::get('customer_guestpass_invoice/{id?}','WebsiteController@customerguestpassInvoice')->name('customer_guestpass_invoice');
Route::get('customerroom_invoice/{id?}','WebsiteController@customerroomInvoice')->name('customer_room_invoice');
Route::get('customertransport_invoice/{id?}','WebsiteController@customertransportInvoice')->name('customertransport_invoice');
Route::get('customerguide_invoice/{id?}','WebsiteController@customerguideInvoice')->name('customer_guide_invoice');


Route::get('hotel-image-remove/{id?}','PropertyController@hotelImageRemove')->name('hotel-image-remove');
Route::post('update-hotel','PropertyController@updateHotel')->name('update-hotel');

Route::get('profile','WebsiteController@profile')->name('profile');
Route::post('update-profile','WebsiteController@updateProfile')->name('update-profile');

Route::get('get-package-invoice/{invoice_num?}/{name?}','SuperAdminController@getPackageInvoice')->name('get-package-invoice');
Route::get('get-guestpass-invoice/{invoice_num?}/{name?}','SuperAdminController@getGuestpassInvoice')->name('get-package-invoice');
Route::get('get-guide-invoice/{invoice_num?}/{name?}','SuperAdminController@getGuideInvoice')->name('get-guide-invoice');
Route::get('get-transport-invoice/{invoice_num?}/{name?}','SuperAdminController@getTransportInvoice')->name('get-transport-invoice');
Route::get('get-room-invoice/{invoice_num?}/{name?}','SuperAdminController@getRoomInvoice')->name('get-room-invoice');
Route::get('user-login','WebsiteController@userLogin')->name('user-login');
Route::get('user-signup','WebsiteController@userSignup')->name('user-signup');
Route::get('vendor-signup','WebsiteController@userSignup')->name('vendor-signup');
Route::get('list-your-services','WebsiteController@listYourServices')->name('list-your-services');

//Reservation Rejection Reason
Route::post('guide_reservation_rejection','WebsiteController@guideReservationRejection')->name('guide_reservation_rejection');
Route::get('checkout','WebsiteController@checkout')->name('checkout');
Route::get('request_refund_by_customer/{ReservationID?}/{category_id?}/{value?}','WebsiteController@requestRefundByCustomer')->name('request_refund_by_customer');
Route::get('package_request_refund_reply/{id?}/{status?}/{value?}','WebsiteController@packageRequestRefundReply')->name('package_request_refund_reply');
Route::get('request_refund_reply/{receipt_num?}/{status?}/{value?}/{category_id?}','WebsiteController@RequestRefundReply')->name('request_refund_reply');

Route::resource('withdrawRequest/withdraw-request', 'WithdrawRequest\\WithdrawRequestController');
Route::post('withdraw-request','WebsiteController@withdrawRequest')->name('withdraw-request');
Route::post('payment-confirmation','WebsiteController@paymentConfirmation')->name('payment-confirmation');
Route::get('get-payment-comment/{id?}','WebsiteController@getPaymentComment')->name('get-payment-comment');
Route::get('add-package-on-homepage/{id?}','WebsiteController@addPackageOnHomepage')->name('add-package-from-homepage');
Route::get('remove-package-from-homepage/{id?}','WebsiteController@removePackageFromHomepage')->name('remove-package-from-homepage');
Route::get('add-guestpass-on-homepage/{id?}','WebsiteController@addGuestPassOnHomepage')->name('add-guestpass-from-homepage');
Route::get('remove-guestpass-from-homepage/{id?}','WebsiteController@removeGuestPassFromHomepage')->name('remove-guestpass-from-homepage');
Route::get('password-reset','WebsiteController@passwordReset')->name('password-reset');

Route::get('guestpass-sorting/{sort_type?}','WebsiteController@guestPassSorting')->name('guestpass-sorting');
Route::get('guestpass-sorting-with-city/{sort_type?}/{city_name?}','WebsiteController@guestPassSortingWithCity')->name('guestpass-sorting-with-city');

Route::post('upload_ck_editor_image/{token?}','WebsiteController@uploadCkEditorImage')->name('upload_ck_editor_image');
Route::get ('view-blog/{id?}','WebsiteController@viewBlog')->name('view-blog');
Route::get ('withdraw-request/{category?}/{receipt_num?}','WebsiteController@withdrawAmountRequest')->name('withdraw-request');
Route::get ('get-withdraw-request-comment/{category?}/{receipt_num?}','WebsiteController@getWithdrawRequestComment')->name('get-withdraw-request-comment');


Route::get ('/return-and-refund','WebsiteController@returnAndRefund')->name('return-and-refund');
Route::get ('/careers','WebsiteController@careers')->name('careers');
Route::get ('/cookies-policy','WebsiteController@cookiesPolicy')->name('cookies-policy');
Route::get ('/media','WebsiteController@media')->name('media');
Route::get ('/why-alzuwar','WebsiteController@whyAlzuwar')->name('why-alzuwar');
Route::get ('/advertise-with-us','WebsiteController@advertiseWithUs')->name('advertise-with-us');
Route::get ('/mecca','WebsiteController@mecca')->name('mecca');
Route::get ('/medina','WebsiteController@medina')->name('medina');
Route::get ('/karbala','WebsiteController@karbala')->name('karbala');
Route::get ('/najaf','WebsiteController@najaf')->name('najaf');
Route::get ('/samarrah','WebsiteController@samarrah')->name('samarrah');
Route::get ('/kadhmain','WebsiteController@kadhmain')->name('kadhmain');
Route::get ('/kufa','WebsiteController@kufa')->name('kufa');
Route::get ('/damascus','WebsiteController@damascus')->name('damascus');
Route::get ('/help','WebsiteController@help')->name('help');
Route::get ('/donations','WebsiteController@donations')->name('donations');

Route::resource('about/about', 'About\\AboutController');
Route::resource('travelAgency/travel-agency', 'TravelAgency\\TravelAgencyController');
Route::resource('agencyImage/agency-image', 'AgencyImage\\AgencyImageController');
Route::resource('visaArrival/visa-arrival', 'VisaArrival\\VisaArrivalController');
Route::resource('contact/contact', 'Contact\\ContactController');
Route::resource('fAQ/f-a-q', 'FAQ\\FAQController');
Route::resource('askAQuestion/ask-a-question', 'AskAQuestion\\AskAQuestionController');
Route::resource('contactDetail/contact-detail', 'ContactDetail\\ContactDetailController');
Route::resource('tourTrip/tour-trip', 'TourTrip\\TourTripController');
Route::resource('testimonial/testimonial', 'Testimonial\\TestimonialController');
Route::resource('discover/discover', 'Discover\\DiscoverController');
Route::resource('blog/blog', 'Blog\\BlogController');
Route::resource('roomType/room-type', 'RoomType\\RoomTypeController');


Route::get ('accepted-withdrawal-packages-deal','WebsiteController@acceptedWithdrawalPackagesDeal')->name('accepted-withdrawal-packages-deal');
Route::get ('pending-withdrawal-packages-deal','WebsiteController@pendingWithdrawalPackagesDeal')->name('pending-withdrawal-packages-deal');
Route::get ('rejected-withdrawal-packages-deal','WebsiteController@rejectedWithdrawalPackagesDeal')->name('rejected-withdrawal-packages-deal');


Route::get ('accepted-withdrawal-hotel','WebsiteController@acceptedWithdrawalHotel')->name('accepted-withdrawal-hotel');
Route::get ('pending-withdrawal-hotel','WebsiteController@pendingWithdrawalHotel')->name('pending-withdrawal-hotel');
Route::get ('rejected-withdrawal-hotel','WebsiteController@rejectedWithdrawalHotel')->name('rejected-withdrawal-hotel');

Route::get ('accepted-withdrawal-shrine-programs','WebsiteController@acceptedWithdrawalShrinePrograms')->name('accepted-withdrawal-shrine-programs');
Route::get ('pending-withdrawal-shrine-programs','WebsiteController@pendingWithdrawalShrinePrograms')->name('pending-withdrawal-shrine-programs');
Route::get ('rejected-withdrawal-shrine-programs','WebsiteController@rejectedWithdrawalShrinePrograms')->name('rejected-withdrawal-shrine-programs');

Route::get ('accepted-withdrawal-transportation','WebsiteController@acceptedWithdrawalTransportation')->name('accepted-withdrawal-transportation');
Route::get ('pending-withdrawal-transportation','WebsiteController@pendingWithdrawalTransportation')->name('pending-withdrawal-transportation');
Route::get ('rejected-withdrawal-transportation','WebsiteController@rejectedWithdrawalTransportation')->name('rejected-withdrawal-transportation');

Route::get ('accepted-withdrawal-guide','WebsiteController@acceptedWithdrawalguide')->name('accepted-withdrawal-guide');
Route::get ('pending-withdrawal-guide','WebsiteController@pendingWithdrawalguide')->name('pending-withdrawal-guide');
Route::get ('rejected-withdrawal-guide','WebsiteController@rejectedWithdrawalguide')->name('rejected-withdrawal-guide');

Route::post('withdraw-request-accept-reject','WebsiteController@withdrawRequestAcceptReject')->name('withdraw-request-accept-reject');


//test
Route::get('test','WebsiteController@test')->name('test');
//Route::get('test1','WebsiteController@test1')->name('test1');
Route::post('test1','WebsiteController@test1')->name('test1');

Route::resource('sPFAQ/s-p-f-a-q', 'SPFAQ\\SPFAQController');