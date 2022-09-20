<?php
Route::group(['prefix' => 'shop'], function(){

 require __DIR__.'/checkout.php';

 Route::get('/','Shop\ShopController@index')->name('shop.index');
 Route::get('/products-type','Shop\CollectionController@collection')->name('shop.product.product-type');
 // Route::get('/products/product-type','Shop\ProductController@featuredProducts')->name('shop.product.featured');
 Route::get('/products/{cateSlug}/{slug}','Shop\ProductController@index2')->name('shop.subcategory');
 Route::get('/products/{cateSlug}/{subcate}/{slug}','Shop\ProductController@index')->name('shop.childcategory');
 Route::get('product/{slug}','Shop\ProductController@detail')->name('shop.product.detail.page');
 Route::get('/cart','Shop\CartController@index')->name('shop.cart');
 Route::get('/wishlist','Shop\CartController@wishlistCart')->name('shop.wishlist');
 Route::get('/thank-you','Shop\CheckoutController@thankyou')->name('shop.checkout.thankyou');

 Route::get('/pages/{slug}','Shop\ShopController@page')->name('shop.cms');



});