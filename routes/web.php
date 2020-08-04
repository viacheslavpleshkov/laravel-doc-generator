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
        Route::get('documents-files', 'DocumentFileController@index')->name('documents-files.index');
        Route::get('documents-files/{id}/edit', 'DocumentFileController@edit')->name('documents-files.edit');
        Route::get('documents-files/{id}', 'DocumentFileController@show')->name('documents-files.show');
        Route::delete('documents-files/{id}', 'DocumentFileController@destroy')->name('documents-files.destroy');
        Route::resource('documents', 'DocumentController');
        Route::resource('orders', 'OrderController');
        Route::get('orders', 'OrderController@index')->name('orders.index');
        Route::get('orders/{id}', 'OrderController@show')->name('orders.show');
        Route::delete('orders/{id}', 'OrderController@destroy')->name('orders.destroy');

        Route::get('roles', 'RoleController@index')->name('roles.index');
        Route::get('role/{id}', 'RoleController@show')->name('roles.show');
        Route::get('roles/{id}/edit', 'RoleController@edit')->name('roles.edit');
        Route::put('roles/{id}', 'RoleController@update')->name('roles.update');
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
    Route::get('about', 'SiteController@about')->name('site.about');
    Route::get('terms-of-use', 'SiteController@terms_of_use')->name('site.terms-of-use');
    Route::get('privacy-policy', 'SiteController@privacy_policy')->name('site.privacy-policy');
});

Route::get('home', function () {
    return redirect()->route('site.index');
});

