 @extends('e-shop.layouts.checkout')
@section('checkContent')
  <fieldset class="step-content" style="">
    @php
        $cart = \App\Models\Shop\ShopCartItems::where('user_id',Auth::user()->id)->where('type','cart')->get();
    @endphp
     <form 
         class="step-form-content" 
         id="shippingForm" 
         action="{{url(route('shop.checkout.shipping'))}}"
         > 
                                <table class="cart__table cart-table">
                                    <thead class="cart-table__head">
                                        <tr class="cart-table__row">
                                            <th class="cart-table__column cart-table__column--image">Image</th>
                                            <th class="cart-table__column cart-table__column--product">Product</th>
                                            <th class="cart-table__column cart-table__column--product">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody class="cart-table__body">

                                        @foreach($cart as $item)
                                        <?php 
                                                $product = $item->product;
                                                $variation = \App\Models\Products\ProductAssignedVariation::find($item->variant_id);
                                        ?>
    
                                            <tr class="cart-table__row">
                                                <td class="cart-table__column cart-table__column--image">
                                                    <a href=""><img src="{{url($product->thumbnail)}}" alt=""></a>
                                                </td>
                                                <td class="cart-table__column cart-table__column--product"><a href="" class="cart-table__product-name">{{$item->product->name}}</a>
                                                     <h4>Product Type: {{$product->product_type == 1 ? 'Variable' : 'Simple'}}</h4>
                                                     <h4>Price: ${{custom_format($item->price,2)}}</h4>
                                                    @if($product->product_type == 1)
                                                      <ul class="cart-table__options">
                                                          @foreach($variation->hasVariationAttributes as $v)
                                                          <li>{{$v->parentVariation->variations->name}}: 
                                                              <b class="bText">{{$v->parentVariation->name}}</b>
                                                          </li>
                                                          @endforeach
                                                          
                                                      </ul>
                                                   @endif
                                                   @if($product->local_pickup && $product->shipping_available)
                                                      <span class="local_pickup_text">Local Pickup and Shipping Both available({{$item->product->name}})</span>
                                                   @endif
                                                </td>
                                                <td  class="cart-table__column cart-table__column--product">
                                                  @if($product->local_pickup && $product->shipping_available)
                                                   <label>Mark Checkbox if you want Local Pickup</label>
                                                   <input type="checkbox" name="pickup[]" value="{{$product->id}}" class="local_picup"/>
                                                  @elseif($product->local_pickup)
                                                   <p>Local Pickup Only</p>
                                                  @else
                                                   <p>Shipping Available Only</p>
                                                  @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                 <div class="col-md-12">

                  <!-- <button class="cstm-btn solid-btn">Continue</button> -->
                  <div class="multistep-footer mt-4 text-right"> 
                  
                  <button type="submit" class="cstm-btn solid-btn submitBTN">Save &amp; Continue</button>
               </div>   

               </div>
                </form>
</fieldset>         
@endsection