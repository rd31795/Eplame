@extends('e-shop.layouts.layout')
@section('styleSheet')
<link rel="stylesheet" type="text/css" href="{{url('/e-shop/css/cart-style.css')}}">
@endsection
@section('content')




    <!-- banner section starts here here -->
    <section class="inner-main-banner" style="background-image:url({{url('/e-shop/images/product-listing-banner-bg.png')}});">
        <div class="container">
            <div class="inner-banner-content text-center">
                <h1>Shopping Cart</h1>
            </div>
        </div>
    </section>
   <!--Shopping cart sec starts here -->
   <section class="shopping-cart-sec">
     <div class="container">
       <div class="cart block">
                <div class="container">
                    
                    @include('e-shop.errors')


                    <table class="cart__table cart-table">
                        <thead class="cart-table__head">
                            <tr class="cart-table__row">
                                <th class="cart-table__column cart-table__column--image">Image</th>
                                <th class="cart-table__column cart-table__column--product">Product</th>
                                <th class="cart-table__column cart-table__column--price">Price</th>
                                <th class="cart-table__column cart-table__column--quantity">Quantity</th>
                                <th class="cart-table__column cart-table__column--total">Total</th>
                                <th class="cart-table__column cart-table__column--remove"></th>
                            </tr>
                        </thead>
                        <tbody class="cart-table__body" id="loadCartItems">
 
                          
                         
                        </tbody>
                    </table>
                   
                    <div class="row justify-content-center pt-5">
                        <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                            <div class="card cart-total-card">
                                <div class="card-body" id="totals">
                                    
                                    
                                </div>


<div class="cart-totals-bottom-block mt-4 mb-4">
                  
                       <!-- <div class="col-lg-12 text-center mb-3">
                           <p class="futura-medium-bt text-uppercase">We Accept</p>
                       </div> -->
                      <div class="headline-wrap cart-totals text-center">
                           <h3 class="headline">We Accept</h3>
                           <span class="line"></span>
                         </div>


                   
                     <div class="d-f justify-content-center w-100">
                         <img class="mr-2" src="{{url('/')}}/images/american-express.png" alt="visa">
                         <img class="mr-2" src="{{url('/')}}/images/discover.png" alt="master card">
                         <img src="{{url('/')}}/images/master-card.png" alt="cash on delivery">
                         <img src="{{url('/')}}/images/visa.png" alt="cash on delivery">
                     </div>
               </div>
                            </div>
                        </div>
                    </div>


                     <div class="cart__actions">
                        <!-- <form class="cart__coupon-form">
                            <label for="input-coupon-code" class="sr-only">Password</label>
                            <input type="text" class="form-control" id="input-coupon-code" placeholder="Coupon Code">
                            <button type="submit" class="cstm-btn solid-btn">Apply Coupon</button>
                        </form> -->
                        <div class="cart__buttons"><a href="{{url(route('shop.index'))}}" class="cstm-btn">Continue Shopping</a>  </div>
                    </div>
                </div>
            </div>
     </div>
   </section>
    <!--Shopping cart sec ends here -->


<input type="hidden" id="CartUpdationURL" value="{{url(route('shop.ajax.cartOperations'))}}">
 
@endsection


 @section('jscript')

<script type="text/javascript">
    
$("body").on('click','a.cartItemQty',function(e){
	e.preventDefault();
     var $this = $( this );
     var type = $this.attr('data-type');
     var id = $this.attr('data-id');
     if($this.attr('data-disable') == 1){
          addToCartFunction(type,id);
     }


});

addToCartFunction();
function addToCartFunction(type="list",id=0) {
    
     var $url =$("body").find('#CartUpdationURL').val();
     var $divPath = $("body").find('#loadCartItems');
     var $totals = $("body").find('#totals');
     $.ajax({
               url : $url,
               data : {
                 type:type,
                 id:id
               },
               type: 'GET',   
               dataTYPE:'JSON',
               headers: {
                 'X-CSRF-TOKEN': $('input[name=_token]').show()
               },
                beforeSend: function() {
                   $("body").find('.custom-loading').show();
                    
                },
                success: function (result) {
                        if(parseInt(result.status) == 1){
                            $divPath.html(result.htm) ;
                            $totals.html(result.totals) ;

                                  $("body").find('.custom-loading').hide();
                                 
                        }else if(parseInt(result.status) == 0){
                              $this.find('#errorMessageBox').text(result.messages);
                              $this.find('.cartButton').removeAttr('disabled');

                        }
               },
               complete: function() {
                        $("body").find('.custom-loading').hide();
               },
               error: function (jqXhr, textStatus, errorMessage) {
                     
               }

   });
}

</script>

 @endsection