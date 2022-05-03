<?php

use Illuminate\Support\Facades\Route;


Route::get('/{any?}', function () {
    return view('website.index');
})->middleware('metaTags')->where('any', '(?!admin)(?!login)(?!register)(?!data)(?!website-data).*$');


Route::group(['namespace' => 'User', 'prefix' => 'website-data'], function () {
    Route::post('/contact-post', 'RouteController@contactPost');
    Route::get('/social-link', 'RouteController@contactAndSocialLink')->name('contactAndSocialLink');
    Route::get('/client', 'RouteController@client')->name('client');
    Route::post('/meta-tags', 'RouteController@metaTags')->name('metaTags');
    Route::get('/portfolio', 'RouteController@portfolio')->name('portfolio');
});



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->get('/admin/{any?}', function () {
    return view('admin.admin');
});

//Data Routes
Route::group(['prefix' => 'data', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
    Route::resource('/page-seo', 'SeoController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('/user', 'UserController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('/review', 'ReviewController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('/team', 'TeamController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('/client', 'ClientController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('/category', 'CategoryController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('/protfolio', 'PortfolioController')->only(['index', 'store', 'update', 'destroy']);
    Route::resource('/social-link', 'SocialmediaController')->only(['index', 'update']);
    Route::resource('/contact', 'ContactController')->only(['index', 'destroy']);
});
