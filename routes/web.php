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
        Route::get('orders', 'AdminController@index')->name('admin.index');
        Route::resource('types', 'TypeController');
        Route::get('situations', 'AdminController@index')->name('admin.index');
        Route::get('documents_files', 'AdminController@index')->name('admin.index');
        Route::get('documents', 'AdminController@index')->name('admin.index');
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
