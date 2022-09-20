<?php

Route::group(['prefix' => 'checkout','middleware' => 'ShopCheckoutCheck'], function(){
   Route::get('/','Shop\CheckoutController@index')->name('shop.checkout.index');
   Route::post('/shipping/save','Shop\CheckoutController@postAddress')->name('shop.checkout.shipping');

   Route::get('/review/cart','Shop\CheckoutController@reviewCart')->name('shop.checkout.reviewCart');
   Route::get('/billing-address','Shop\CheckoutController@billingAddress')->name('shop.checkout.billingAddress');
   Route::post('/billing-address','Shop\CheckoutController@postBillingAddress')->name('shop.checkout.billingAddress');

   Route::get('/payment','Shop\CheckoutController@payment')->name('shop.checkout.payment');
   Route::post('/stripe/payment','Shop\CheckoutController@postPaymentStripe')->name('shop.checkout.stripe.payment');
   
   //Paypal Payment Routes
   Route::any('/paypal/payment','Shop\PaypalController@handlePayment')->name('shop.checkout.paypal.payment');
   Route::get('/paypal/cancel-payment', 'Shop\PaypalController@paymentCancel')->name('shop.checkout.paypal.cancel.payment');
   Route::get('/paypal/payment-success', 'Shop\PaypalController@paymentSuccess')->name('shop.checkout.paypal.success.payment');
});
