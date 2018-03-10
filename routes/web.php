<?php

    Route::get('/','DefaultController@index')->middleware('tran');

    Route::group(['middleware'=>['checklog','tran','auth','web']],function (){

        Route::get('/home','DefaultController@index');
        Route::get('/admin/locale/{locale}','DefaultController@locale');
        Route::get('/admin','DefaultController@AdminPanel');
        Route::get('/role/view','RoleController@index');
        Route::post('/admin/create/role','RoleController@createRole');
        Route::get('/admin/delete/role/{id}','RoleController@deleteRole');
        Route::get('/admin/update/role/edit/{id}','RoleController@edit');
        Route::get('/admin/role/update/{id}','RoleController@updateRole');
        Route::patch('/admin/role/update/{id}','RoleController@updateRole');

        //Position Route
        Route::get('/admin/position/create','PositionController@createPosition');
        Route::post('/admin/position/store','PositionController@store');
        Route::get('/admin/position/delete/{id}','PositionController@deletePosition');

        Route::get('/admin/position/edit/{id}','PositionController@edit');
        Route::patch('/admin/position/update/{id}','PositionController@updatePosition');

        //user
        Route::get('/admin/user','UserController@create');
        Route::post('/admin/user/stored','UserController@stored');
        Route::get('/admin/user/edit/{id}','UserController@edit');
        Route::patch('/admin/user/update/{id}','UserController@update');
        Route::get('/admin/user/view/{id}','UserController@viewUser');
        Route::get('/admin/user/delete/{id}','UserController@delete');
        Route::get('/admin/get/user','UserController@getUserList');
        Route::get('/admin/reset/password/{id}','UserController@resetPassword');
        Route::patch('/admin/reset/user/password/{id}','UserController@resetPasswordSuccess');

        //categories (create category and article)
        Route::resource('/category','CategoryController');
        Route::get('/category/delete/{id}','CategoryController@deleteCate');
        Route::get('/category/edit/{id}','CategoryController@edit');


        //Article
        Route::resource('/article','ArticleController');

        //Language
        Route::resource('/language','LanguageController');
        Route::get('/language/edit/{id}','LanguageController@edit');
        Route::patch('/language/update/{id}','LanguageController@update');
        Route::get('/language/delete/{id}','LanguageController@destroy');


        //category product
        Route::resource('/categoryproduct','categoryProductController');

        //category
        Route::resource('/category','CategoryController');
        Route::get('/category/edit/{id}','CategoryController@edit');
        Route::patch('/category/update/{id}','CategoryController@update');
        Route::get('/category/delete/{id}','CategoryController@destroy');













    });
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
