
<input type="hidden" id="expressCheckoutUrl" value="{{ route('checkout.expressCheckout') }}">

<input type="hidden" id="pay_amount" value="{{$orders->event_budget * 100}}">
<input type="hidden" id="pay_url" value="{{ route('user_payToVendor') }}">
<input type="hidden" id="pay_email" value="">
<input type="hidden" id="pay_vendor_id" value="">
<input type="hidden" id="pay_business_id" value="">



<input type="hidden" id="pay_event_id" value="0">
<input type="hidden" id="pay_category_id" value="">
<input type="hidden" id="pay_balance_transaction" value="Payement by Paypal">
<input type="hidden" id="pay_success_url" value="{{ route('registration.thank-you') }}">

<!-- <div id="paypal-button-container"></div> -->

<div>
	<button onclick="expressCheckout()" id="paypal_btn" type="button" class="cstm-btn solid-btn">Pay by Paypal</button>
</div>
