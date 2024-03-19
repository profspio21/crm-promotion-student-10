<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/dashboard-graph', 'HomeController@graph')->name('dashboard');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Staff
    Route::delete('staffs/destroy', 'StaffController@massDestroy')->name('staffs.massDestroy');
    Route::resource('staffs', 'StaffController');

    // Registrant
    Route::post('registrants/parse-csv-import', 'RegistrantController@parseCsvImport')->name('registrants.parseCsvImport');
    Route::post('registrants/process-csv-import', 'RegistrantController@processCsvImport')->name('registrants.processCsvImport');
    Route::post('registrants/report', 'RegistrantController@report')->name('registrants.report');
    Route::delete('registrants/destroy', 'RegistrantController@massDestroy')->name('registrants.massDestroy');
    Route::post('registrants/media', 'RegistrantController@storeMedia')->name('registrants.storeMedia');
    Route::post('registrants/ckmedia', 'RegistrantController@storeCKEditorImages')->name('registrants.storeCKEditorImages');
    Route::resource('registrants', 'RegistrantController');

    // Expo
    Route::post('expos/report', 'ExpoController@report')->name('expos.report');
    Route::get('expos/report-detail-expo', 'ExpoController@reportDetailExpo')->name('expos.reportDetailExpo');
    Route::post('expos/parse-csv-import', 'ExpoController@parseCsvImport')->name('expos.parseCsvImport');
    Route::post('expos/process-csv-import', 'ExpoController@processCsvImport')->name('expos.processCsvImport');
    Route::delete('expoes/destroy', 'ExpoController@massDestroy')->name('expoes.massDestroy');
    Route::resource('expoes', 'ExpoController');

    // Detail Expo
    Route::delete('detail-expoes/destroy', 'DetailExpoController@massDestroy')->name('detail-expoes.massDestroy');
    Route::resource('detail-expoes', 'DetailExpoController');

    // Information
    Route::delete('informations/destroy', 'InformationsController@massDestroy')->name('informations.massDestroy');
    Route::post('informations/ckmedia', 'InformationsController@storeCKEditorImages')->name('informations.storeCKEditorImages');
    Route::post('informations/media', 'InformationsController@storeMedia')->name('informations.storeMedia');
    Route::resource('informations', 'InformationsController');

    // Pusat informasi seleksi untuk pendaftar
    Route::resource('selection-informations', 'SelectionInformationController')->parameters(['selection-informations' => 'information']);
    Route::resource('comments', 'CommentsController');

    // Pusat informasi seleksi untuk pendaftar
    Route::resource('activity-informations', 'ActivityInformationController')->parameters(['activity-informations' => 'information']);
    
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
