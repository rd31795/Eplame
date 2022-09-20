<?php
Route::group(['prefix' => 'home/product-list'], function() {


#-----------------------------------------------------------------------------------
//   Home Page Banner
#-----------------------------------------------------------------------------------
Route::get('/','Admin\Shop\ProductListingHomeController@index')->name('admin.home.product.listing');
Route::get('/create','Admin\Shop\ProductListingHomeController@createform')->name('admin.home.productlist.setting');
Route::post('/create','Admin\Shop\ProductListingHomeController@store')->name('admin.home.productlist.create');
// Route::post('/home/setting','Admin\Shop\BannerController@store')->name('admin.banner.home.setting.create');
Route::get('/edit/{id}','Admin\Shop\ProductListingHomeController@edit')->name('admin.home.productlist.edit');
Route::post('/edit/{productlist_update_id}','Admin\Shop\ProductListingHomeController@store')->name('admin.home.productlist.update');
Route::get('/status/{id}','Admin\Shop\ProductListingHomeController@status')->name('admin.home.productlist.status');
Route::get('/viewall/{id}','Admin\Shop\ProductListingHomeController@viewAllToggle')->name('admin.home.productlist.viewAllToggle');
Route::get('/delete/{id}','Admin\Shop\ProductListingHomeController@delete')->name('admin.home.productlist.delete');
});
