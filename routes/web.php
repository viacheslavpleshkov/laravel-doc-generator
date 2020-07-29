<?php

use Illuminate\Support\Facades\Route;
/**
 * Auth Router
 */
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});
/**
 * Admin Router
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'roles'], 'block' => ['User']], function () {
});
/**
 * Site Router
 */
Route::namespace('Site')->group(function () {
    Route::get('/', 'SiteController@index')->name('site.index');
    Route::get('about', 'SiteController@about')->name('site.about');
    Route::get('terms-of-use', 'SiteController@terms_of_use')->name('site.terms-of-use');
    Route::get('privacy-policy', 'SiteController@privacy-polic')->name('site.privacy-policy');
});
