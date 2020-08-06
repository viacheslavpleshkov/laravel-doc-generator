<?php

use Illuminate\Support\Facades\Route;

/**
 * Auth Router
 */
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
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
        Route::resource('types', 'TypeController');
        Route::resource('situations', 'SituationController');
        Route::resource('documents-files', 'DocumentFileController');

        Route::get('documents', 'DocumentFileController@index')->name('documents-files.index');
        Route::get('documents/{id}', 'DocumentFileController@show')->name('documents-files.show')->where('id', '[0-9]+');
        Route::delete('documents/{id}', 'DocumentFileController@destroy')->name('documents-files.destroy')->where('id', '[0-9]+');

        Route::get('{document}/document-key', 'DocumentController@index')->name('documents.index')->where('document', '[0-9]+');
        Route::get('{document}/document-key/create', 'DocumentController@create')->name('documents.create')->where('document', '[0-9]+');
        Route::post('{document}/document-key', 'DocumentController@store')->name('documents.store');
        Route::get('{document}/document-key/{id}', 'DocumentController@show')->name('documents.show');
        Route::get('{document}/document-key/{id}/edit', 'DocumentController@edit')->name('documents.edit')->where(['document' => '[0-9]+', 'id' => '[0-9]+']);
        Route::put('{document}/document-key/{id}', 'DocumentController@update')->name('documents.update')->where(['document' => '[0-9]+', 'id' => '[0-9]+']);
        Route::delete('{document}/document-key/{id}', 'DocumentController@destroy')->name('documents.destroy');

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
    Route::get('situation/{id}', 'SiteController@types')->name('site.situation');
    Route::get('about', 'SiteController@about')->name('site.about');
    Route::get('how-to-protect-your-rights', 'SiteController@protect')->name('site.protect');
    Route::get('terms-of-use', 'SiteController@terms_of_use')->name('site.terms-of-use');
    Route::get('privacy-policy', 'SiteController@privacy_policy')->name('site.privacy-policy');
});

Route::get('home', function () {
    return redirect()->route('site.index');
});

