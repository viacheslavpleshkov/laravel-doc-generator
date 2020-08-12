<?php

use Illuminate\Support\Facades\Route;

/**
 * Auth Router
 */
Route::group(['namespace' => 'Auth'], function () {
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
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'roles'], 'block' => ['User']], function () {
    Route::group(['roles' => ['Admin']], function () {
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::get('orders', 'AdminController@index');
        Route::resource('news', 'NewsController');
        Route::resource('types', 'TypeController');
        Route::resource('situations', 'SituationController');
        Route::resource('documents-files', 'DocumentFileController');

        Route::get('{document}/document-key', 'DocumentKeyController@index')->name('documents-keys.index')->where('document', '[0-9]+');
        Route::get('{document}/document-key/create', 'DocumentKeyController@create')->name('documents-keys.create')->where('document', '[0-9]+');
        Route::post('{document}/document-key', 'DocumentKeyController@store')->name('documents-keys.store');
        Route::get('{document}/document-key/{id}', 'DocumentKeyController@show')->name('documents-keys.show');
        Route::get('{document}/document-key/{id}/edit', 'DocumentKeyController@edit')->name('documents-keys.edit')->where(['document' => '[0-9]+', 'id' => '[0-9]+']);
        Route::put('{document}/document-key/{id}', 'DocumentKeyController@update')->name('documents-keys.update')->where(['document' => '[0-9]+', 'id' => '[0-9]+']);
        Route::delete('{document}/document-key/{id}', 'DocumentKeyController@destroy')->name('documents-keys.destroy');

        Route::resource('orders', 'OrderController');
        Route::get('orders', 'OrderController@index')->name('orders.index');
        Route::get('orders/{id}', 'OrderController@show')->name('orders.show')->where('id', '[0-9]+');
        Route::delete('orders/{id}', 'OrderController@destroy')->name('orders.destroy')->where('id', '[0-9]+');

        Route::get('roles', 'RoleController@index')->name('roles.index');
        Route::get('role/{id}', 'RoleController@show')->name('roles.show')->where('id', '[0-9]+');
        Route::get('roles/{id}/edit', 'RoleController@edit')->name('roles.edit')->where('id', '[0-9]+');
        Route::put('roles/{id}', 'RoleController@update')->name('roles.update')->where('id', '[0-9]+');

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
    Route::get('types/{url}', 'SiteController@types')->name('site.types');
    Route::get('news', 'NewsController@index')->name('site.news.index');
    Route::get('news/{url}', 'NewsController@news')->name('site.news.view');
    Route::get('situation/{id}', 'SituationController@index')->name('site.situation.index');
    Route::middleware('auth')->group(function () {
        Route::post('situation/{id}', 'SituationController@form')->name('site.situation.form');
        Route::get('payment/{id}', 'PaymentController@index')->name('site.payment.index');
        Route::get('payment-success', 'PaymentController@success')->name('site.payment.success');
        Route::get('payment-fall', 'PaymentController@fall')->name('site.payment.fall');
    });
    Route::get('about', 'SiteController@about')->name('site.about');
    Route::get('terms-of-use', 'SiteController@terms_of_use')->name('site.terms-of-use');
    Route::get('privacy-policy', 'SiteController@privacy_policy')->name('site.privacy-policy');
});

Route::get('home', function () {
    return redirect()->route('site.index');
});

