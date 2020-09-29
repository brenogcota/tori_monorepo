<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------|
*/

Route::group(['prefix'=>'/auth','as'=>'auth.'], function(){
    Route::get('/signin', 'AuthController@index')->name('signin');
    Route::post('/signin', ['middleware' =>  ['verify_email'], 'uses' => 'AuthController@signIn'])->name('signin');
    
});

/*
|--------------------------------------------------------------------------
| Password reset routes
|--------------------------------------------------------------------------|
*/

Route::post('sendforgotpasswordmail', 'Mail\ResetPasswordController@sendForgotPasswordMail')->name('sendforgotpasswordmail');
Route::get('forgotpassword', 'Mail\ResetPasswordController@create')->name('forgotpassword');
Route::post('resetpassword', 'Mail\ResetPasswordController@resetPassword')->name('resetpassword');
Route::get('seller/verifyemail', 'Mail\VerifyEmailController@verifyEmail')->name('verifyemail');
Route::get('seller/resendmail', 'Mail\VerifyEmailController@resendMail')->name('resendmail');


Route::get('/logout', 'AuthController@logout')->name('logout');


Route::group(['middleware' => ['auth2']], function () {

    Route::get('/', 'Admin\HomeController@index');
    Route::get('/home', 'Admin\HomeController@index')->name('home');

    /*
    |--------------------------------------------------------------------------
    | Seller routes
    |--------------------------------------------------------------------------|
    */

    Route::group(['middleware' => 'check_is_admin', 'prefix'=>'/lojista','as'=>'lojista.'], function(){
        Route::get('/', 'SellerController@index')->name('index');
        Route::get('/create', 'SellerController@create')->name('create');
        Route::post('/store', 'SellerController@store')->name('store');
        Route::get('/show/{id}', 'SellerController@show')->name('show');
        Route::get('/upgrade/{id}', 'SellerController@upgrade')->name('upgrade');
        Route::post('/update/{id}', 'SellerController@update')->name('update');
        Route::get('/delete/{id}', 'SellerController@destroy')->name('delete');
    });


    /*
    |--------------------------------------------------------------------------
    | Category routes
    |--------------------------------------------------------------------------|
    */ 

    Route::group(['prefix'=>'/categoria','as'=>'categoria.'], function(){
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('/create', 'CategoryController@create')->name('create');
        Route::post('/store', 'CategoryController@store')->name('store');
        Route::get('/show/{id}', 'CategoryController@show')->name('show');
        Route::get('/upgrade/{id}', 'CategoryController@upgrade')->name('upgrade');
        Route::post('/update/{id}', 'CategoryController@update')->name('update');
        Route::get('/delete/{id}', 'CategoryController@destroy')->name('delete');
    });

    /*
    |--------------------------------------------------------------------------
    | Sub Category routes
    |--------------------------------------------------------------------------|
    */

    Route::group(['prefix'=>'/subcategoria','as'=>'subcategoria.'], function(){
        Route::get('/', 'SubCategoryController@index')->name('index');
        Route::get('/create', 'SubCategoryController@create')->name('create');
        Route::post('/store', 'SubCategoryController@store')->name('store');
        Route::get('/show/{id}', 'SubCategoryController@show')->name('show');
        Route::get('/upgrade/{id}', 'SubCategoryController@upgrade')->name('upgrade');
        Route::post('/update/{id}', 'SubCategoryController@update')->name('update');
        Route::get('/delete/{id}', 'SubCategoryController@destroy')->name('delete');
    });


    /*
    |--------------------------------------------------------------------------
    | Product routes
    |--------------------------------------------------------------------------|
    */ 

    Route::group(['prefix'=>'/produto','as'=>'produto.'], function(){
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('/create', 'ProductController@create')->name('create');
        Route::post('/store', 'ProductController@store')->name('store');
        Route::get('/show/{id}', 'ProductController@show')->name('show');
        Route::get('/upgrade/{id}', 'ProductController@upgrade')->name('upgrade');
        Route::post('/update/{id}', 'ProductController@update')->name('update');
        Route::get('/delete/{id}', 'ProductController@destroy')->name('delete');
    });


    /*
    |--------------------------------------------------------------------------
    | Users routes
    |--------------------------------------------------------------------------|
    */ 

    Route::group(['middleware' => 'check_is_admin', 'prefix'=>'/usuario','as'=>'usuario.'], function(){
        Route::get('/', 'User\UserController@index')->name('index');
        Route::get('/show/{id}', 'User\UserController@show')->name('show');
    });

   
    
});




