<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class vendorShipping extends FormRequest
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
        return [
            "phone_number"=>"required",
            "address"=>"required",
            "country"=>"required",
            "state"=>"required",
            "city"=>"required",
            "zipcode"=>"required"
        ];
    }
}
