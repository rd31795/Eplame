<?php




Route::group(['prefix' => 'shop/ajax'], function(){
 Route::post('/wishlist/{id}','Shop\CartController@wishlist')->name('shop.wishlist.create');
 Route::get('/featured-category','Shop\ShopController@featuredCategory')->name('shop.ajax.featuredCategory');
 Route::post('/category/product/filter/{id}','Shop\ProductFilterController@index')->name('shop.ajax.product.sidebarFilter');
 Route::get('/add-to-cart/product/{id}','Shop\CartController@addToCart')->name('shop.ajax.addToCart');
 Route::get('/negotiation-coupon/{product_id}','Shop\CartController@isCouponValid')->name('shop.ajax.negotiationcoupon');
 Route::get('/cart-operations','Shop\CartController@cartOperations')->name('shop.ajax.cartOperations');
 Route::get('/wishlist-operations','Shop\CartController@wishlistOperations')->name('shop.ajax.wishlistOperations');
 Route::get('/shipping/rates','Shop\CartController@shippingrates')->name('shipping.rates');
 Route::get('/getprice/{product_id}','Shop\CartController@productPrice')->name('shop.ajax.getprice');
});