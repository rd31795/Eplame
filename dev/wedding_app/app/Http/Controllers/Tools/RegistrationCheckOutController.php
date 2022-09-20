<?php

namespace App\Http\Controllers\Tools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Registrationcheckoutproccess\Billing_reg;
class RegistrationCheckOutController extends Controller
{
    use Billing_reg;
    public function __construct(Request $request)
    {   $stripe = SripeAccount();
        \Stripe\Stripe::setApiKey($stripe['sk']);
       
    }
}
