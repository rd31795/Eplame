<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class NegotiationValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()){
          return true;
        }else{
          return false;
        }
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $v=[
           "customer_email"=>'required|email',
           "coupon_code"=>'required|string|max:10|unique:negotiation_discounts,coupon',
           "product"=>'required',
           "negotiation_discount_type"=>'required|in:0,1',
        ];

       switch ($this->negotiation_discount_type) {
           case 0:
               $v['amount']='required|numeric|digits_between:1,2';
               break;
           case 1:
               $v['amount']='required|numeric|digits_between:1,5';
               break;
           default:
               $v['amount']='required|numeric|digits:0';
               break;
       }
       if($this->checkcoupon){
         $v=[
          "coupon_code"=>'unique:negotiation_discounts,coupon',
         ];
       }
             return $v;
    }
}
