<?php

    Route::get('/','DefaultController@index')->name('front')->middleware('tran');
    Route::get('/admin/locale/front/{locale}','DefaultController@frontLocale');

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
        Route::get('/admin/position/index','PositionController@index');
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

        //category product
        Route::resource('/categoryproduct','categoryProductController');
        Route::get('/category/product/change/parent/{id}','categoryProductController@changeParent');
        Route::get('/category/product/edit/{id}/{language_id}','categoryProductController@edit');
        Route::get('/category/product/delete/{id}','categoryProductController@show');
        //Price List
        Route::resource('/pricelist','priceLishController');




        //Brand
        Route::resource('/brand','brandController');
        Route::get('/brand/edit/{id}','brandController@edit');
        //product
        Route::resource('/product','productController');
        Route::get('/product/get-content/view','productController@getViewContent');
        Route::get('/product/delete/{id}','productController@show');
        Route::get('/product/delete/{id}','productController@show');
        Route::get('/product/view-detail/{id}','productController@detail');
        Route::get('/product/delete-image-detail/{id}','productController@deletImgdetail');


        //category
        Route::resource('/category','CategoryController');
        Route::get('/category/edit/{id}/{langId}','CategoryController@edit');
        Route::patch('/category/update/{id}','CategoryController@update');
        Route::get('/category/delete/{id}','CategoryController@destroy');
        Route::get('/get/select/parent','CategoryController@getSelectParent');
        Route::get('/get/select/language/{id}','CategoryController@getSelectLanguage');
        Route::get('/get/select/parent/{id}','CategoryController@selectParent');

        //client
        Route::resource('/client','ClientController');
        Route::get('/client/delete/{id}','ClientController@destroy');
        Route::get('/client/edit/{id}/{langId}','ClientController@edit');

        //news
        Route::resource('/news','NewsController');
        Route::get('/news/delete/{id}','NewsController@destroy');
        Route::get('/news/edit/{id}/{langId}','NewsController@edit');

        //jobcategory
        Route::resource('/jobcategory','JobcategoryController');
        Route::get('/jobcategory/delete/{id}','JobcategoryController@destroy');
        Route::get('/jobcategory/edit/{id}/{langId}','JobcategoryController@edit');

        //jobtype
        Route::resource('/jobtype','JobtypeController');
        Route::get('/jobtype/delete/{id}','JobtypeController@destroy');
        Route::get('/jobtype/edit/{id}/{langId}','JobtypeController@edit');

        //career
        Route::resource('/career','CareerController');
        Route::get('/career/delete/{id}','CareerController@destroy');
        Route::get('/career/edit/{id}/{langId}','CareerController@edit');
        Route::get('/get/select/by/language/{id}','CareerController@selectByLanguage');
        Route::get('/get/view/{id}/{langId}','CareerController@show');

        //contact
        Route::resource('/contact','ContactController');
        Route::get('/contact/edit/{id}','ContactController@edit');
        Route::patch('/contact/update/{id}','ContactController@update');
        Route::get('/contact/delete/{id}','ContactController@destroy');

        //promotion
        Route::resource('/promotion','promotionController');
        Route::get('/promotion/view-promotion/list','promotionController@viewList');
        Route::get('/promotion/delete/{id}','promotionController@show');
        Route::get('/promotion/view-detail/{id}','promotionController@viewPro');

        //About Us
        Route::resource('/aboutus','aboutUsController');
        Route::get('/aboutus/delete-record/{id}','aboutUsController@deleteAb');













    });
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
