<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
##########################################################################
 Deveolper Name : Narinder Singh
 Email : bajwa7696346232@gmail.com
##########################################################################

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
  sudo kill -9 `sudo lsof -t -i:9001`


*/


//Route::post('/vendor/register', 'HomeController@create')->name('vendor_register');


  


error_reporting(E_ALL);

require __DIR__.'/routing/user/checkout.php';
require __DIR__.'/routing/home/routes.php';
require __DIR__.'/routing/home/ajax.php';


require __DIR__.'/routing/shop/routes.php';
require __DIR__.'/routing/shop/ajax.php';


require __DIR__.'/routing/admin/routes.php';
require __DIR__.'/routing/vendor/routes.php';
require __DIR__.'/routing/user/ajax.php';
require __DIR__.'/routing/user/routes.php';







Route::get('/emailss',function(){





	 /*\Mail::send('emails.demo',[], function($message){
               $message->to('bajwa7696346232@gmail.com', 'Abc')
               ->subject('test');
               
    });*/
 //  $msg = \App\Models\Vendors\ChatMessage::find(8);
 // return view('emails.chat.quote')->with('msg',$msg);
 });


Route::get('/demoo',function(){

$ups = upsArray();
$accessKey = $ups['UPS_ACCESS_KEY'];
$userId = $ups['UPS_USER_ID'];
$password = $ups['UPS_PASSWORD'];

$address = new \Ups\Entity\Address();
$address->setAttentionName('Test Test');
$address->setBuildingName('Test');
$address->setAddressLine1('Address Line 1');
$address->setAddressLine2('Address Line 2');
$address->setAddressLine3('Address Line 3');
$address->setStateProvinceCode('NYw');
$address->setCity('New Yorkwse');
$address->setCountryCode('USs');
$address->setPostalCode('100df00');

$xav = new \Ups\AddressValidation($accessKey, $userId, $password);
$xav->activateReturnObjectOnValidate(); //This is optional
try {
     $response = $xav->validate($address, $requestOption = \Ups\AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION, $maxSuggestion = 15);
     dd($response);
} catch (Exception $e) {
    var_dump($e);
}
});


Route::get('/test/event','Users\UserEventController@testEvent')->name('testEvent.index');




Route::get('/shipping','ShippingController@index')->name('shipping.index');


Route::get('/maintanance',function(){
    return view('errors.503');
});

Route::get('/errors/401',function(){
   return view('errors.401');
});
Route::get('/errors/403',function(){
   return view('errors.403');
});
Route::get('/errors/419',function(){
   return view('errors.419');
});
Route::get('/errors/429',function(){
   return view('errors.429');
});
Route::get('/errors/500',function(){
   return view('errors.500');
});

Route::get('/test/editor',function(){
	return view('errors.test');
});

Route::get('/check/template_style',function(){
   return view('event_templates.event-template-3');
});

Route::get('/test/edit','ShippingController@testControllerFunction');