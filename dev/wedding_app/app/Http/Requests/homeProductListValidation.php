<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Auth;
class homeProductListValidation extends FormRequest
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
            'heading'=>'required|string|min:3|max:200',
            'allcategory'=>'required'
        ];
        // if($this->productlist_update_id){
        //     $v['productlist_update_id']='required';
        // }

         return $v;
    }
}
