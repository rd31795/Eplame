 <form action="{{url('/registration/payment-stripe2/'.$orders->id)}}" method="POST">
  <?php $stripe = SripeAccount();  ?>
  @csrf
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button new-main-button"
    data-key="{{$stripe['pk']}}"
    data-amount="{{$data->reg_type * 100}}"
    data-name="Envision"
    data-description="Shopping"                           
    data-locale="auto">
  </script>
</form>

 