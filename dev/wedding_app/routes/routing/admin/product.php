<?php
Route::group(['prefix' => 'product'], function() {


Route::get('shop/listing','Admin\Shop\ShopController@index')->name('admin.shop.listing');
Route::get('shop/list/{id}','Admin\Shop\ShopController@detail')->name('admin.shop.list.detail');
Route::get('shop/listing/ajax','Admin\Shop\ShopController@ajax')->name('admin.shop.listing.ajax');
Route::get('shop/product/{slug}/listing','Admin\Shop\ShopController@products')->name('admin.shop.products.listing');


Route::get('shop/product/{slug}/listing/ajax/{status}','Admin\Shop\ShopController@productAjax')
->name('admin.shop.products.listing.ajax');
Route::get('shop/product/{slug}/{productSlug}','Admin\Shop\ShopController@productDetail')
->name('admin.shop.products.detail');


Route::get('shop/product/{slug}/{productSlug}/approved','Admin\Shop\ShopController@productApproved')
->name('admin.shop.products.approved');

Route::get('shop/product/{slug}/{productSlug}/rejection','Admin\Shop\ShopController@productRejection')
                                                    ->name('admin.shop.products.rejection');


Route::post('shop/product/{slug}/{productSlug}/rejection','Admin\Shop\ShopController@productRejected')
                                                    ->name('admin.shop.products.rejection');



Route::get('shop/{slug}/rejection','Admin\Shop\ShopController@shopRejection')->name('admin.shop.rejection');
Route::post('shop/{slug}/rejection','Admin\Shop\ShopController@shopRejected')->name('admin.shop.rejection');
Route::get('shop/{slug}/approved','Admin\Shop\ShopController@shopApproved')->name('admin.shop.approved');





Route::get('shop/product/all/listing/{status}','Admin\Shop\ShopController@productListing')
         ->name('admin.shop.products.all.listing');

Route::get('shop/product/all/listing/{status}/ajax','Admin\Shop\ShopController@productListingAjax')
         ->name('admin.shop.products.all.listing.ajax');

Route::get('shop/product/listing/delete/{id}','Admin\Shop\ShopController@productDelete')
         ->name('admin.shop.products.delete');
#-----------------------------------------------------------------------------------
#  Category Management
#-----------------------------------------------------------------------------------

Route::get('category','Admin\Products\CategoryController@index')->name('admin.products.category');
Route::get('category/create','Admin\Products\CategoryController@create')->name('admin.products.category.create');
Route::post('category/create','Admin\Products\CategoryController@store')->name('admin.products.category.create');
Route::post('category/sorting','Admin\Products\CategoryController@sorting')->name('admin.products.category.sorting');
Route::get('/get-subcategory-by-parent','Admin\Products\CategoryController@category')->name('admin.products.category.data');
Route::get('category/delete/{id}','Admin\Products\CategoryController@delete')->name('admin.products.category.delete');
Route::get('category/edit/{id}','Admin\Products\CategoryController@edit')->name('admin.products.category.edit');
Route::post('category/edit/{id}','Admin\Products\CategoryController@update')->name('admin.products.category.edit');


#-----------------------------------------------------------------------------------
#  Category Variations
#-----------------------------------------------------------------------------------

Route::get('category/variations/{id}','Admin\Products\CategoryController@variation')->name('admin.products.category.variation');
Route::post('category/variations/{id}','Admin\Products\CategoryController@postVariation')->name('admin.products.category.variation');


#-----------------------------------------------------------------------------------
#  Create Variation
#-----------------------------------------------------------------------------------

Route::get('variations','Admin\Products\VariationController@index')->name('admin.products.create.variations');
Route::post('variations','Admin\Products\VariationController@store')->name('admin.products.create.variations');
Route::get('variation/edit/{id}','Admin\Products\VariationController@index')->name('admin.products.edit.variations');
Route::post('variation/edit/{id}','Admin\Products\VariationController@store')->name('admin.products.edit.variations');




Route::get('variations/custom/fields/{type}','Admin\Products\VariationController@fields')->name('admin.products.custom.fields.variations');


Route::post('variations/custom/fields/{type}','Admin\Products\VariationController@postVariation')->name('admin.products.custom.fields.variations');


Route::get('variations/custom/fields/{type}/{id}','Admin\Products\VariationController@fields')->name('admin.products.custom.fields.edit.variations');
Route::post('variations/custom/fields/{type}/{id}','Admin\Products\VariationController@postVariation')->name('admin.products.custom.fields.edit.variations');
Route::get('variations/custom/fields/delete/{type}/{id}','Admin\Products\VariationController@fieldDelete')->name('admin.products.custom.fields.delete.variations');
#-----------------------------------------------------------------------------------
#  Product Variation Management
#-----------------------------------------------------------------------------------

Route::get('variations/{type}','Admin\Products\ProductVariationController@index')->name('admin.products.variations');
Route::get('variations/{type}/create','Admin\Products\ProductVariationController@create')->name('admin.products.variation');
Route::post('variations/{type}/create','Admin\Products\ProductVariationController@store')->name('admin.products.variation');

Route::get('variations/{type}/edit/{id}','Admin\Products\ProductVariationController@edit')->name('admin.products.variation.edit');
Route::post('variations/{type}/edit/{id}','Admin\Products\ProductVariationController@update')->name('admin.products.variation.edit');

Route::get('variations/{type}/ajax','Admin\Products\ProductVariationController@Ajax')->name('admin.products.variationAjax');

#-----------------------------------------------------------------------------------
#  Category Management
#-----------------------------------------------------------------------------------



#-----------------------------------------------------------------------------------
#  Product Brands Routes
#-----------------------------------------------------------------------------------

Route::get('list/brands','Admin\Products\BrandController@index')->name('admin.products.list.brands');
Route::get('list/brands/create','Admin\Products\BrandController@create')->name('admin.products.create.brands');
Route::post('list/brands/create','Admin\Products\BrandController@store')->name('admin.products.create.brands');
Route::get('list/brands/edit/{id}','Admin\Products\BrandController@edit')->name('admin.products.edit.brands');
Route::post('list/brands/edit/{id}','Admin\Products\BrandController@update')->name('admin.products.edit.brands');
Route::get('list/brands/event_status/{id}','Admin\Products\BrandController@event_status')->name('admin.products.brands.event_status');
Route::get('list/brands/ajax','Admin\Products\BrandController@Ajax')->name('admin.products.brandsAjax');

#-----------------------------------------------------------------------------------
#  Product Brands Routes End
#-----------------------------------------------------------------------------------


Route::get('shop/pages','Admin\Shop\PageController@index')->name('admin.shop.cms');
Route::get('shop/pages/create','Admin\Shop\PageController@add')->name('admin.shop.cms.create');
Route::post('shop/pages/create','Admin\Shop\PageController@store')->name('admin.shop.cms.create');


Route::get('shop/pages/delete/{id}','Admin\Shop\PageController@delete')->name('admin.shop.cms.delete');
Route::get('shop/pages/edit/{id}','Admin\Shop\PageController@edit')->name('admin.shop.cms.edit');
Route::post('shop/pages/edit/{id}','Admin\Shop\PageController@update')->name('admin.shop.cms.edit');

#-----------------------------------------------------------------------------------
#  Product Type Routes (12/12/2021)
#-----------------------------------------------------------------------------------
 Route::get('types','Admin\Products\ProductTypeController@index')->name('admin.products.list.types');
 Route::get('types/create','Admin\Products\ProductTypeController@create')->name('admin.products.create.types');
 Route::post('types','Admin\Products\ProductTypeController@save')->name('admin.products.save.types');
 Route::get('types/ajax','Admin\Products\ProductTypeController@Ajax')->name('admin.products.typesAjax');
 Route::get('types/{id}','Admin\Products\ProductTypeController@edit')->name('admin.products.edit.types');
 Route::patch('types/{id}','Admin\Products\ProductTypeController@update')->name('admin.products.update.types');
 Route::get('types/{id}/status','Admin\Products\ProductTypeController@status')->name('admin.products.status.types');
#-----------------------------------------------------------------------------------
#  Product Type Routes End
#-----------------------------------------------------------------------------------

#-----------------------------------------------------------------------------------
#  Product Featured Packages Start
#-----------------------------------------------------------------------------------

Route::get('featured-packages','Admin\FeaturedPackagesControllers@index')->name('admin.home.product.featured-package');
Route::get('featured-packages/add','Admin\FeaturedPackagesControllers@add')->name('admin.home.product.featured-package.add');
Route::post('featured-package/store','Admin\FeaturedPackagesControllers@store')->name('admin.home.product.featured-package.store');
Route::get('featured-package/packages','Admin\FeaturedPackagesControllers@getPackages')->name('ajax_getpackages');
Route::get('featured_product_status/{id}','Admin\FeaturedPackagesControllers@toggleStatus')->name('featured_product_status');
Route::get('featured_product_edit/{id}','Admin\FeaturedPackagesControllers@edit')->name('featured_product_edit');
Route::post('featured_product_edit/{id}','Admin\FeaturedPackagesControllers@update')->name('admin.home.product.featured-package.update');
Route::get('featured-package-order','Admin\FeaturedPackagesControllers@packagesOrder')->name('admin.home.product.packages_purchase');
Route::get('featured-package-order-content','Admin\FeaturedPackagesControllers@OrderContent')->name('ajax_getpackages_order');
#-----------------------------------------------------------------------------------
#  Product Featured Packages End
#-----------------------------------------------------------------------------------
});