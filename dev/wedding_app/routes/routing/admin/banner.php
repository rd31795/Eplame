<?php
Route::group(['prefix' => 'banner'], function() {


#-----------------------------------------------------------------------------------
//   Home Page Banner
#-----------------------------------------------------------------------------------
Route::get('/home/setting','Admin\Shop\BannerController@index')->name('admin.banner.home.setting');
Route::post('/home/setting','Admin\Shop\BannerController@store')->name('admin.banner.home.setting.create');

#-----------------------------------------------------------------------------------
//  Short Description Banner
#-----------------------------------------------------------------------------------
Route::get('/short-description/setting','Admin\Shop\BannerController@shortDescriptionIndex')->name('admin.banner.home.shortdescription');


#-----------------------------------------------------------------------------------
  Route::get('/home/slider','Admin\Shop\SliderController@index')->name('admin.banner.home.slider');
  Route::get('/home/slider/status/{id}','Admin\Shop\SliderController@status')->name('admin.slider.status');
  Route::get('/home/slider/edit/{id}','Admin\Shop\SliderController@edit')->name('admin.slider.edit');
  Route::get('/home/slider/delete/{id}','Admin\Shop\SliderController@delete')->name('admin.slider.delete');
  Route::get('/home/slider/create','Admin\Shop\SliderController@create')->name('admin.slider.create');
  Route::get('/home/slider/slider-ajax','Admin\Shop\SliderController@sliderAjax')->name('admin.slider.sliderAjax');
  Route::post('/home/slider/create','Admin\Shop\SliderController@store')->name('admin.slider.create');
  Route::post('/home/slider/edit/{id}','Admin\Shop\SliderController@update')->name('admin.slider.edit');
#-----------------------------------------------------------------------------------
});
