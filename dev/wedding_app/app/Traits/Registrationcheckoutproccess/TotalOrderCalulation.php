<?php
namespace App\Traits\Registrationcheckoutproccess;
use Illuminate\Http\Request;
 
use App\VendorPackage;
use App\PackageMetaData;
use App\UserEventMetaData;
use Auth;
use App\Models\Vendors\DiscountDeal;
use App\Models\EventOrder;
use Session;

use App\VendorCommission;
trait TotalOrderCalulation {





public function getTotalOrderCurrent($event_id)
{

	$total = $this->getTotalOfOrderItems($event_id);
	//$total = ($total + $this->getTaxWithAddress());

	//$total = ($total + $this->getCommissionFee($this->getTotalOfOrderItems()));
	//$total = ($total + $this->getServiceFee($this->getTotalOfOrderItems($event_id),$event_id));
    return $total;
}




#---------------------------------------------------------------------------------------
#  get tax according to address
#---------------------------------------------------------------------------------------


public function getTaxWithAddress()
{
     $billing = Session::has('billingAddress') ? json_decode(Session::get('billingAddress')) : [];
     return !empty($billing->tax) ? $billing->tax : 0;
}



#---------------------------------------------------------------------------------------
#  get Current Order Total
#---------------------------------------------------------------------------------------


public function getTotalOfOrderItems($event_id)
{
    $order = $this->getCurentOrders($event_id);
    $data = $this->getBillingAddress();
    return $data->reg_type;
}


#---------------------------------------------------------------------------------------
#  commission and service fee according to vendor
#---------------------------------------------------------------------------------------

public function CommissionFeeServiceAccordingVendor($type="STRIPE",$account_status=0)
{
	 $order = $this->getCurentOrders();
	 $orders = $order->groupBy('vendor_id')->get();
     $arr =[];
     $account =[];
	 foreach ($orders as $key => $value) {
	 	$venOrd = $this->getCurentOrders();
	 	$amount = $venOrd->where('vendor_id',$value->vendor_id)->sum('discounted_price');
        $account_id = $type == "STRIPE" ? $value->vendor->stripe_account : $value->vendor->paypal_account;
        $service_fee = $this->getServiceFee($amount);
        $commission_fee = $this->getCommissionFee($amount);


        $payable_amount = round($amount - ($service_fee + $commission_fee));

        $stripeAccountParams= (array)["amount" => $payable_amount,"stripe_account" => $account_id];

        array_push($account, $stripeAccountParams);

	 	$arr[$value->vendor_id] = [
           'vendor_id' => $value->vendor_id,
           'total' => $this->getTotalOrderCurrent(),
           'sum' => $this->getTotalOfOrderItems(),
           'amount' => $amount,
           'tax' => $this->getTaxWithAddress(),
           'commission_fee' => $commission_fee,
           'service_fee' => $service_fee,
           'payable_amount' => $payable_amount,
           'account_id' => $account_id,
           'stripeAccountParams' => $stripeAccountParams
	 	];


	 	//array_push($arr[$value->vendor_id], $arr1);
	 }

	 return $account_status == 0 ? $arr : $account;
 
}


#---------------------------------------------------------------------------------------
#  get Current Order Total
#---------------------------------------------------------------------------------------


// public function getCommissionFee($total=null)
// {
// 	$datas = VendorCommission::where('vendor_id',Auth::user()->id)->get();
// 	if($datas->count() > 0)
// 	{
// 		foreach($datas as $data)
// 		{

// 		if($data->commission_type == 1)
// 		{
// 			$commission_fee = $data->min_amount;
// 			return $commission_fee;
// 		}else{
// 			$totalAmount = $total == null ? $this->getTotalOfOrderItems()  : $total;
// 		  return getFee2($totalAmount, 'commission_fee_type', $data->amount);
// 		}
// 	}
	
// 	}else{
//      $totalAmount = $total == null ? $this->getTotalOfOrderItems($event_id)  : $total;
//     return getFee($totalAmount, 'commission_fee_type', 'commission_fee_amount');
// 	}
// }
#---------------------------------------------------------------------------------------
#  get Current Order Total
#---------------------------------------------------------------------------------------


public function getServiceFee($total=null,$event_id)
{

    $totalAmount = $total == null ? $this->getTotalOfOrderItems($event_id)  : $total;
    return getFee($totalAmount, 'service_fee_type', 'service_fee_amount');
}



#------------------------------------------------------------------------------------------
#  get Total Summary
#------------------------------------------------------------------------------------------

public function getTotalWithTr()
{
	$text ='';
	$text .='<tr>';
	$text .='<th>Service Fee</th>';
	$text .='<td><strong><span class="plus-sign">+</span>$'.custom_format($this->getServiceFee(),2).'</strong></td>';
	$text .='</tr>	';

	// $text .='<tr>';
	// $text .='<th>Commission Fee</th>';
	// $text .='<td><strong><span class="plus-sign">+</span>$'.custom_format($this->getCommissionFee(),2).'</strong></td>';
	// $text .='</tr>	';

if(Session::has('billingAddress')){


	$text .='<tr>';
	$text .='<th>Tax</th>';
	$text .='<td><strong><span class="plus-sign">+</span>  $'.custom_format($this->getTaxWithAddress(),2).'</strong></td></tr>';
}
	$text .='<tr>';
	$text .='<th>Order Total</th>';
	$text .='<td><strong>$'.custom_format($this->getTotalOrderCurrent($event_id),2).'</strong></td>';
	$text .='</tr>';
	$text .='<input type="hidden" id="CurrentCartTotal" value="'.$this->getTotalOrderCurrent($event_id).'">';
 return $text;
}
























}














