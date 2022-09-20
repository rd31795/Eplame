<?php

Route::get('/logout', function () {
\Auth::logout();
return redirect('/login');
})->name('logout');
Auth::routes(['verify' => true]);


Route::post('/login', 'LoginController@check')->name('post_login');
Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/home', 'HomeController@index')->name('homepage2');
Route::post('/home2', 'HomeController@eventsearch')->name('home.eventsearch');
Route::get('/about-us', 'HomeController@about')->name('about_us');

Route::get('/events-all', 'HomeController@events_all')->name('events_all');



Route::get('/contact-us', 'HomeController@contact')->name('contact_us');
Route::post('/contact-us', 'HomeController@contactsend')->name('home.cms.contact_us');

Route::get('/vendor/register', 'HomeController@register')->name('vendor_register');



#------------------------------------------------------------------------------------------
#  Vendor Listing Page
#------------------------------------------------------------------------------------------
 Route::get('/vendor-listing', 'Home\Services\VendorListingController@index')->name('home_vendor_listing_page');
 Route::get('/detail-page', 'Home\Services\ServiceDetailController@index')->name('service_deatil_page');


 
 Route::get('/listing/{cateSlug}/{vendorSlug}', 'Home\Services\ServiceDetailController@index2')->name('vendor_detail_page');

 Route::get('/custom/listing/{cateSlug}/{vendorSlug}', 'Home\Services\ServiceDetailController@index2')->name('home.vendor.customPackage');

 Route::get('/page/{slug}', 'HomeController@showCmsPage')->name('cmsPage');
 Route::get('/venues', 'Home\Services\VendorListingController@venue')->name('get_all_venues');

 Route::get('/faq', 'HomeController@faq')->name('home.faq');

 // weather api
 Route::get('/venue/getweather', 'Home\Services\ServiceDetailController@getweather')->name('get_venue_weather');
 Route::get('/venue/get-weather', 'Home\Services\ServiceDetailController@get_weather')->name('get_venue_weathers');





#------------------------------------------------------------------------------------------
#  Vendor Listing Page
#------------------------------------------------------------------------------------------
 Route::get('/deals-discounts', 'Home\Deals\DealsController@index')->name('all_deals');
 Route::get('/deal/{slug}', 'Home\Deals\DealsController@detail')->name('get_deal_detail');

Route::get('/my-cart', 'Users\Cart\CartController@index')->name('my_cart');
Route::get('/my-cart-delete/{id}', 'Users\Cart\CartController@delete')->name('cart.delete');
Route::get('/my-wishlist-delete/{id}', 'Users\Cart\CartController@wishlistDelete')->name('wishlist.delete');
Route::get('/my-wishlist', 'Users\Cart\CartController@wishlist')->name('my_wishlist');






#---------------------------------------------------------------------------------------------------
#  email template testing
#---------------------------------------------------------------------------------------------------
///vendor/update/UWFZT2xnOFJnZmZMdDFBclpncEYzV2ZhcmtFQjVVYzl0OGZhRnY4TjIwMjAtMDEtMDk=5e16e8bfd9f93

 Route::get('/vendor/update/{id}', 'HomeController@vendorUpdate')->name('vendor.update');
 Route::get('/request/messages', 'HomeController@requestMessages')->name('request.messages');

 Route::get('/email/testing', 'HomeController@email')->name('email.test');

 Route::get('thanks/{id}/{status}','Tools\GuestListController@thanks')->name('invitation.thanks');

 Route::get('forum','Tools\ForumController@index')->name('community');

 Route::get('/forum/discussion/{slug}', 'Tools\ForumController@discussionDetail')->name('forum.discussion.detail');

 Route::get('/forum/group/{slug}', 'Tools\ForumController@groupDetail')->name('forum.group.detail');

 Route::get('/forum/group/{slug}/members', 'Tools\ForumController@groupMembers')->name('forum.group.members'); 

 Route::get('/forum/group/{slug}/discussions', 'Tools\ForumController@groupDiscussions')->name('forum.group.discussions');

 Route::get('/forum/group/{slug}/photos', 'Tools\ForumController@groupPhotos')->name('forum.group.photos');

 Route::get('/forum/group/{slug}/videos', 'Tools\ForumController@groupVideos')->name('forum.group.videos');

 Route::get('/forum/discussions', 'Tools\ForumController@discussions')->name('forum.discussions');

 Route::get('/forum/user/{id}/wall', 'Tools\ForumController@usersWall')->name('forum.user.wall');

 Route::get('/forum/user/{id}/discussions', 'Tools\ForumController@usersDiscussions')->name('forum.user.discussions');
 
 Route::get('/forum/user/{id}/photos', 'Tools\ForumController@usersPhotos')->name('forum.user.photos');

 Route::get('/forum/user/{id}/videos', 'Tools\ForumController@usersVideos')->name('forum.user.videos');

 Route::get('/forum/user/{id}/friends', 'Tools\ForumController@usersFriends')->name('forum.user.friends');

 Route::get('/forum/user/{id}/events', 'Tools\ForumController@usersEvents')->name('forum.user.events');
 Route::get('/forum/user/{id}/{slug}/event', 'Tools\ForumController@usersEventDetail')->name('forum.user.eventDetail');

 /*registration payment*/
 Route::get('/registration/{id}/{slug}/event', 'Tools\ForumController@usersEventRegistrationForm')->name('user.event.registration');
 Route::post('/registration/{id}/{slug}/event', 'Tools\RegistrationCheckOutController@postAddress')->name('user.event.registration');

 	Route::get('/order-summary/{id}','Tools\RegistrationCheckOutController@orderSummary')->name('checkout.orderSummary2');
 	Route::get('/order-summary-data','Tools\RegistrationCheckOutController@getOrderSummary')->name('checkout.getOrderSummary2');

  	Route::get('/registration/payment2/{id}','Tools\RegistrationCheckOutController@paymentPage')->name('checkout.paymentPage2');
  	Route::get('/registration/payment-free/{id}','Tools\RegistrationCheckOutController@freePayment')->name('checkout.payment-free');
 	Route::post('/registration/payment-stripe2/{id}','Tools\RegistrationCheckOutController@payWithStripereg')->name('checkout.payWithStripereg');
 	Route::get('/registration/payment-paypal2/{id}','Tools\RegistrationCheckOutController@payWithPaypalreg')->name('checkout.payWithPaypalreg');
 	Route::get('/registration/thank-you-payment/{id}', 'Tools\RegistrationCheckOutController@CreateOrders')->name('checkout.thankyou');

 	Route::post('/payment2','Tools\RegistrationCheckOutController@stripeorder')->name('checkout.stripeorder2');
 	Route::get('/thank-you', 'Tools\RegistrationCheckOutController@thankyou')->name('registration.thank-you');
 	Route::get('/thank-you-for-payment', 'Tools\RegistrationCheckOutController@thankyou1')->name('thank-you-payment');
/* end registration payment*/
 Route::get('/forum/users', 'Tools\ForumController@users')->name('forum.users');

 Route::get('/calculator', 'Tools\CalculatorController@index')->name('calculator');

 Route::get('/reviews/thank-you', 'Users\BusinessReviewsController@thanks')->name('review.thanks');

 Route::post('/post_a_feedback', 'HomeController@postFeedback')->name('feedback.post');
 Route::post('/report_a_bug', 'HomeController@reportBug')->name('bug.report');
 Route::post('/request_a_feature', 'HomeController@requestFeature')->name('feature.request');
 Route::get('/eventDetail/{slug}', 'HomeController@eventDetail')->name('home.eventDetail');


Route::get('/get-current-location','HomeController@getLocation')->name('current_location');