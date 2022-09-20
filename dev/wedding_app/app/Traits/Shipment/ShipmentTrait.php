<?php
namespace App\Traits\Shipment;
use App\Traits\ShopCheckout\ShopCheckoutShippingTrait;
use EasyPost\Shipment;
use EasyPost\EasyPost;
use EasyPost\Error;
use Auth;
trait ShipmentTrait {
  use ShopCheckoutShippingTrait;
  public function shipping($vendor,$shop,$product,$to_address){
    $from_address=$vendor->shippingAddresses;
    \EasyPost\EasyPost::setApiKey(env('EASYPOST_API'));
    $shipment = \EasyPost\Shipment::create(array(
        "to_address" => array(
            "name"=> $to_address->name,
            "company"=>null,
            "street1"=> $to_address->address,
            "city"=> $to_address->city,
            "state"=> $to_address->state,
            "zip"=> $to_address->zipcode,
            "country"=> $to_address->country_short_code,
            "phone"=> $to_address->phone_number,
            "mode"=> "test",
            "carrier_facility"=> null,
            "residential"=> $to_address->address,
            "email"=> $to_address->email,
        ),
        "from_address" => array(
            "name"=> $vendor->name,
            "company"=> $shop->name,
            "street1"=> $from_address->address,
            "street2"=> $from_address->address_2,
            "city"=> $from_address->city,
            "state"=> $from_address->state,
            "zip"=> $from_address->zipcode,
            "country"=> $from_address->country,
            "phone"=> $from_address->phone_number,
            "mode"=> "test",
            "carrier_facility"=> null,
            "residential"=> null,
            "email"=> $vendor->email,
        ),
        "parcel" => array(
          "length" => 1,
          "width" => 1,
          "height" => 1,
          "weight" => 352.74
        )
      ));
     $shipment->buy($shipment->lowest_rate());
      return $shipment;
      
  }

  public function getShippingRates($vendor,$to_address){
    $from_address=$vendor->shippingAddresses;
    \EasyPost\EasyPost::setApiKey(env('EASYPOST_API'));
    $shipment = \EasyPost\Shipment::create(array(
        "to_address" => array(
            "name"=> Auth::user()->name,
            "company"=>null,
            "street1"=>"getting rate",
            "city"=> $to_address->city,
            "state"=> $to_address->state,
            "zip"=> $to_address->zipcode,
            "country"=> $to_address->country_short_code,
            "phone"=> Auth::user()->phone_number,
            "mode"=> "test",
            "carrier_facility"=> null,
            "residential"=> "getting shipping rates",
            "email"=>Auth::user()->email,
        ),
        "from_address" => array(
            "name"=> $vendor->name,
            "company"=>null,
            "street1"=> $from_address->address,
            "street2"=> $from_address->address_2,
            "city"=> $from_address->city,
            "state"=> $from_address->state,
            "zip"=> $from_address->zipcode,
            "country"=> $from_address->country,
            "phone"=> $from_address->phone_number,
            "mode"=> "test",
            "carrier_facility"=> null,
            "residential"=> null,
            "email"=> $vendor->email,
        ),
        "parcel" => array(
          "length" => 1,
          "width" => 1,
          "height" => 1,
          "weight" => 352.74
        )
      ));
     if($to_address->zipcode){
      return $shipment->lowest_rate();
     }else{
      return false;
     }
      
  }
}


