<?php

use Illuminate\Support\Facades\Route;

/**
 * Auth Router
 */
Route::group(['namespace' => 'Auth'], function () {
//    Если видети этот комментарий это значит, что заказчик не расчитался до конца.
//    Было внесено кучу правок помимо ТЗ в итоге кинул нас на деньги
//    будьте осторожны
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login/attempt', 'LoginController@attempt')->name('login.attempt');
    Route::get('login/{token}/validate', 'LoginController@login')->name('login.token.validate')->middleware('signed');
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');
    Route::post('logout', 'LoginController@logout')->name('logout');
});
/**
 * Admin Router
 */
//    Если видети этот комментарий это значит, что заказчик не расчитался до конца.
//    Было внесено кучу правок помимо ТЗ в итоге кинул нас на деньги
//    будьте осторожны
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'roles'], 'block' => ['User']], function () {
    Route::group(['roles' => ['Admin']], function () {
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::get('orders', 'AdminController@index');
        Route::resource('news', 'NewsController');
        Route::resource('types', 'TypeController');
        Route::resource('situations', 'SituationController');
        Route::resource('documents-files', 'DocumentFileController');
//    Если видети этот комментарий это значит, что заказчик не расчитался до конца.
//    Было внесено кучу правок помимо ТЗ в итоге кинул нас на деньги
//    будьте осторожны
        Route::get('{document}/document-key', 'DocumentKeyController@index')->name('documents-keys.index')->where('document', '[0-9]+');
        Route::get('{document}/document-key/create', 'DocumentKeyController@create')->name('documents-keys.create')->where('document', '[0-9]+');
        Route::post('{document}/document-key', 'DocumentKeyController@store')->name('documents-keys.store');
        Route::get('{document}/document-key/{id}', 'DocumentKeyController@show')->name('documents-keys.show');
        Route::get('{document}/document-key/{id}/edit', 'DocumentKeyController@edit')->name('documents-keys.edit')->where(['document' => '[0-9]+', 'id' => '[0-9]+']);
        Route::put('{document}/document-key/{id}', 'DocumentKeyController@update')->name('documents-keys.update')->where(['document' => '[0-9]+', 'id' => '[0-9]+']);
        Route::delete('{document}/document-key/{id}', 'DocumentKeyController@destroy')->name('documents-keys.destroy');
//    Если видети этот комментарий это значит, что заказчик не расчитался до конца.
//    Было внесено кучу правок помимо ТЗ в итоге кинул нас на деньги
//    будьте осторожны
        Route::resource('orders', 'OrderController');
        Route::get('orders', 'OrderController@index')->name('orders.index');
        Route::get('orders/{id}', 'OrderController@show')->name('orders.show')->where('id', '[0-9]+');
        Route::delete('orders/{id}', 'OrderController@destroy')->name('orders.destroy')->where('id', '[0-9]+');
//    Если видети этот комментарий это значит, что заказчик не расчитался до конца.
//    Было внесено кучу правок помимо ТЗ в итоге кинул нас на деньги
//    будьте осторожны
        Route::get('roles', 'RoleController@index')->name('roles.index');
        Route::get('role/{id}', 'RoleController@show')->name('roles.show')->where('id', '[0-9]+');
        Route::get('roles/{id}/edit', 'RoleController@edit')->name('roles.edit')->where('id', '[0-9]+');
        Route::put('roles/{id}', 'RoleController@update')->name('roles.update')->where('id', '[0-9]+');
//    Если видети этот комментарий это значит, что заказчик не расчитался до конца.
//    Было внесено кучу правок помимо ТЗ в итоге кинул нас на деньги
//    будьте осторожны
        Route::resource('users', 'UserController');
        Route::get('settings', 'SettingController@index')->name('settings.index');
        Route::put('settings', 'SettingController@update')->name('settings.update');
    });
});
/**
 * Site Router
 */
Route::namespace('Site')->group(function () {
    Route::get('/', 'SiteController@index')->name('site.index');
    Route::get('news', 'NewsController@index')->name('site.news.index');
    Route::get('news/{url}', 'NewsController@news')->name('site.news.view');
    Route::get('types/{url}', 'SiteController@types')->name('site.types');
    Route::get('types/{type_url}/situation/{situation_id}/document/{document_id}', 'SituationController@index')->name('site.situation.index');
    Route::post('types/{type_url}/situation/{situation_id}/document/{document_id}', 'SituationController@form')->name('site.situation.form');
    Route::middleware('auth')->group(function () {
        Route::get('types/{type_url}/situation/{situation_id}/document/{document_id}/payment', 'PaymentController@index')->name('site.payment.index');
        Route::post('payment-submit/{type_id}/{situation_id}/{document_id}', 'PaymentController@submit')->name('site.payment.submit');
        Route::get('payment-success', 'PaymentController@success')->name('site.payment.success');
        Route::get('payment-fall', 'PaymentController@fall')->name('site.payment.fall');
    });
    Route::get('about', 'SiteController@about')->name('site.about');
    Route::get('useragreement', 'SiteController@terms_of_use')->name('site.terms-of-use');
    Route::get('personaldatapolicy', 'SiteController@personaldatapolicy')->name('site.personaldatapolicy');
    Route::get('confidentialitypolicy', 'SiteController@privacy_policy')->name('site.privacy-policy');
    Route::get('user-delete-information', 'SiteController@deleteUser')->name('site.user-delete');
    Route::get('user-delete-information/{id}', 'SiteController@deleteUserFillInput')->name('site.user-delete-information');
});

Route::get('home', function () {
    return redirect()->route('site.index');
});

