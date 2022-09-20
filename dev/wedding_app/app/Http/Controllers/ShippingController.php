<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ups;
use Ups\Entity\Shipment;
use Ups\Entity\Address;
use Ups\Entity\ShipFrom;
use Ups\Entity\Package;
class ShippingController extends Controller
{

    public function testControllerFunction(request $request){
       dd($request->all());
    }
    public function index()
    {
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
                $address->setStateProvinceCode('NY');
                $address->setCity('New York');
                $address->setCountryCode('US');
                $address->setPostalCode('10000');

                $xav = new \Ups\AddressValidation($accessKey, $userId, $password);
                $xav->activateReturnObjectOnValidate(); //This is optional
                try {
                    $response = $xav->validate($address, $requestOption = \Ups\AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION, $maxSuggestion = 15);

                        if ($response->noCandidates()) {
                            
                           echo 1;  
                            
                        }

                } catch (Exception $e) {
                    var_dump($e);
                }

    }


#============================================================================================#


    public function checkAddressIsValidOrNot($response)
    {       
             if ($response->noCandidates()) {
                 $status = [
                     'status' => 0,
                     'message' => 'Invalid Addess'
                 ];
                            
              }
    }






#============================================================================================#
#============================================================================================#
#============================================================================================#
    public function getRateLists()
    {
                     

                $rate = new Ups\RateTimeInTransit(
                    $accessKey,
                    $userId,
                    $password
                );

                try {
                    $shipment = new \Ups\Entity\Shipment();

                    $shipperAddress = $shipment->getShipper()->getAddress();
                    $shipperAddress->setPostalCode('99205');

                    $address = new \Ups\Entity\Address();
                    $address->setPostalCode('99205');
                    $shipFrom = new \Ups\Entity\ShipFrom();
                    $shipFrom->setAddress($address);

                    $shipment->setShipFrom($shipFrom);

                    $shipTo = $shipment->getShipTo();
                    $shipTo->setCompanyName('Test Ship To');
                    $shipToAddress = $shipTo->getAddress();
                    $shipToAddress->setPostalCode('99205');

                    $package = new \Ups\Entity\Package();
                    $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
                    $package->getPackageWeight()->setWeight(10);
                    
                    // if you need this (depends of the shipper country)
                    $weightUnit = new \Ups\Entity\UnitOfMeasurement;
                    $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_LBS);
                    $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);

                    $dimensions = new \Ups\Entity\Dimensions();
                    $dimensions->setHeight(10);
                    $dimensions->setWidth(10);
                    $dimensions->setLength(10);

                    $unit = new \Ups\Entity\UnitOfMeasurement;
                    $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

                    $dimensions->setUnitOfMeasurement($unit);
                    $package->setDimensions($dimensions);

                    $shipment->addPackage($package);

                    $deliveryTimeInformation = new \Ups\Entity\DeliveryTimeInformation();
                    $deliveryTimeInformation->setPackageBillType(\Ups\Entity\DeliveryTimeInformation::PBT_NON_DOCUMENT);
                    
                    $pickup = new \Ups\Entity\Pickup();
                    $pickup->setDate("20170520");
                    $pickup->setTime("160000");
                    $shipment->setDeliveryTimeInformation($deliveryTimeInformation);

                    dd($rate->shopRatesTimeInTransit($shipment));
                } catch (Exception $e) {
                    var_dump($e);
                }

    }
#============================================================================================#
#============================================================================================#
#============================================================================================#














}
