<?php
Route::group(['prefix' => 'shop'], function(){




Route::get('/create','Vendor\Shop\ShopController@first')->name('vendor.shop.index');
Route::post('/check-availability-shop','Vendor\Shop\ShopController@check')->name('shop.ajax.checkAvailablityValiadation');
Route::post('/create-shop-steps/{id}','Vendor\Shop\ShopController@firstStep')->name('shop.ajax.firstStep');
Route::get('/category/choose','Vendor\Shop\ShopController@secondStep')->name('shop.ajax.secondStep');
Route::get('/category/subcategory/choose','Vendor\Shop\ShopController@thirdStep')->name('shop.ajax.thirdStep');
Route::get('/','Vendor\Shop\ShopController@index')->name('vendor.shop');




Route::get('/status/change','Vendor\Shop\ShopController@changeStatus')->name('vendor.shop.changeStatus');

#=============================================================================================================
#  Create Products
#=============================================================================================================

Route::get('/products','Vendor\Shop\ProductController@index')->name('vendor.shop.products.index');
Route::get('/products/create','Vendor\Shop\ProductController@create')->name('vendor.shop.products.create');
Route::get('/products/edit/{id}','Vendor\Shop\ProductController@edit')->name('vendor.shop.products.edit');
Route::post('/products/edit/{id}','Vendor\Shop\ProductController@update')->name('vendor.shop.products.edit');
Route::post('/products/save/category/{id}','Vendor\Shop\ProductController@saveCategory')->name('vendor.shop.products.saveCategory');
Route::get('/product/{id}/change/status','Vendor\Shop\ProductController@status')->name('vendor.shop.products.status');


#=============================================================================================================
#  Create Products
#=============================================================================================================
Route::get('/products/ajax/category','Vendor\Shop\ProductController@ajaxCategory')->name('vendor.shop.products.ajax.categories');




Route::post('/products/ajax/update/generalSetting/{id}','Vendor\Shop\ProductController@createGeneralSetting')->name('vendor.shop.products.ajax.createGeneralSetting');



Route::post('/products/ajax/multiple-image-uploading/{id}','Vendor\Shop\ProductController@imageUploading')->name('vendor.shop.products.ajax.imageUploading');

Route::post('/products/ajax/multiple-image-delete/{product_id}/{id}','Vendor\Shop\ProductController@imageDelete')->name('vendor.shop.products.ajax.DeleteImageUploading');


#=============================================================================================================
#  Product Variation Ajax
#=============================================================================================================


Route::get('/products/ajax/category/{id}','Vendor\Shop\VariationController@types')->name('vendor.shop.variation.types');
Route::get('/products/ajax/save/attributes/{id}','Vendor\Shop\VariationController@attributes')->name('vendor.shop.variation.attributes');
Route::post('/products/ajax/save/attributes/{id}','Vendor\Shop\VariationController@saveAttributes')->name('vendor.shop.variation.attributes');


Route::get('/products/ajax/add/item/variations/attributes/{id}','Vendor\Shop\VariationController@variationAttributeAddationItem')->name('vendor.shop.variations.add.attributes');


#=============================================================================================================
#  Product Inventory Ajax
#=============================================================================================================

Route::post('/products/ajax/save/Inventory/product/{id}',
	       'Vendor\Shop\VariationController@createInventory')->name('vendor.shop.variations.inventoryCreate');


Route::get('/products/ajax/load/steps/{id}',
	       'Vendor\Shop\VariationController@loadSteps')->name('vendor.shop.variations.loadSteps');

Route::get('/products/ajax/remove/product-vaariation-with-type/{id}',
				       'Vendor\Shop\VariationController@removeProductVariationWithType')
			           ->name('vendor.shop.variations.removeProductVariationWithType');






Route::post('/products/ajax/create/variation-with-stock/{id}',
				       'Vendor\Shop\VariationController@createNewVariationWithAttributeAndStockManagable')
			           ->name('vendor.shop.variations.createNewVariationWithAttributeAndStockManagable');




Route::get('/check/sku-id/exist/ornot',
				       'Vendor\Shop\VariationController@checkSkU')
			           ->name('vendor.shop.variations.checkSkU');

#=============================================================================================================
#  Create Products
#=============================================================================================================

 
Route::get('/orders','Vendor\Shop\OrderController@index')->name('vendor.shop.orders');
Route::get('/order/{id}','Vendor\Shop\OrderController@detail')->name('vendor.shop.orders.detail');

#======================================================================================================
# vendor negotiable discount coupon
#======================================================================================================
 Route::get('/negotiation-discount','Vendor\Shop\NegotiationDiscount@index')->name('vendor.negotiable_coupon');
 Route::get('/negotiation-discount/add','Vendor\Shop\NegotiationDiscount@showCreate')->name('vendor.negotiable_coupon.add');
 Route::get('/negotiation-discount/search','Vendor\Shop\NegotiationDiscount@searchProduct')->name('vendor.negotiable_coupon.search');
 Route::get('/negotiation-discount/status/{id}','Vendor\Shop\NegotiationDiscount@toggleStatus')->name('vendor.negotiable_coupon.status');
 Route::get('/negotiation-discount/product-price','Vendor\Shop\NegotiationDiscount@ProductPrice');
 Route::post('/negotiation-discount/add','Vendor\Shop\NegotiationDiscount@Create')->name('vendor.negotiable_coupon.add');
Route::get('/negotiation-discount/check-coupon','Vendor\Shop\NegotiationDiscount@checkCoupon');

#======================================================================================================
# Deals of the Day
#====================================================================================================
Route::get('/deal-of-day','Vendor\Shop\DealsOfDayController@index')->name('vendor.shop.products.deal_of_day');
Route::post('/deal-of-day','Vendor\Shop\DealsOfDayController@index')->name('vendor.shop.products.deal_of_day.create');

#======================================================================================================
# Make any category featured for particular user and show their product on top of the list in shop pages based on package
#======================================================================================================

Route::get('/featured_product','Vendor\Shop\FeaturedProductCategoryController@index')->name('vendor.shop.featured');
Route::get('/featured_category/update','Vendor\Shop\FeaturedProductCategoryController@assignFeaturedCategory')->name('vendor.shop.featuredcategory');
});