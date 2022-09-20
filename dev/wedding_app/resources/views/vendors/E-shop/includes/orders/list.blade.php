   
@foreach($orders as $item)
        <?php
            $product = $item->product;
            $variation = \App\Models\Products\ProductAssignedVariation::find($item->variant_id);
            $user_details=\App\Models\Shop\ShopOrder::where('orderID',$item->orderID)->first();
            $shipping_details=\App\Models\Shop\ShopOrder::where('orderID',$item->orderID)->first();
            $details=json_decode($user_details->shipping_address);
            $shipping=json_decode($user_details->billing_address);
         ?>

                         <tr class="cart-table__row">
                                <td class="cart-table__column cart-table__column--image">
                                    <a href="">
                                        <img src="{{url($product->thumbnail)}}" alt="" width="120">
                                    </a>
                                </td>
                                <td class="cart-table__column cart-table__column--product">
                                    <a href="" class="cart-table__product-name">{{$product->name}}</a>
                                    <h4>Product Type: {{$product->product_type == 1 ? 'Variable' : 'Simple'}}</h4>
                                   
                                  @if($product->product_type == 1)
                                    <ul class="cart-table__options">
                                        @foreach($variation->hasVariationAttributes as $v)
                                        <li>{{$v->parentVariation->variations->name}}: <b class="bText">{{$v->parentVariation->name}}</b></li>
                                        @endforeach
                                        
                                    </ul>
                                 @endif
                                </td>
                                <td class="cart-table__column cart-table__column--price" data-title="Price">
                                   ${{custom_format($item->price,2)}}    

                                </td>
                                <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
                                    <div class="input-number">
                                           {{$item->quantity}} {{$item->quantity > 1 ? 'Items' : 'Item'}}
                                    </div>
                                </td>
                                <td class="cart-table__column cart-table__column--total" data-title="Total">
                                        ${{custom_format(($item->price * $item->quantity),2)}} 
                                </td>
                                <td class="cart-table__column cart-table__column--details" data-title="details">
                                     @if($product->local_pickup)
                                      <h4><u>Local Pickup</u></h4>
                                      <div class="user_details">
                                         Name: <strong>{{$details->name}}</strong><br>
                                         Email: <strong>{{$details->email}}</strong><br>
                                         Phone Number: <strong>{{$details->phone_number}}</strong>
                                      </div>
                                     @else
                                      <h4><u>Shipping</u> </h4>
                                      <div class="shipping_details">
                                         Name: <strong>{{$shipping->name}}</strong><br>
                                         Email: <strong>{{$shipping->email}}</strong><br>
                                         Phone Number: <strong>{{$shipping->phone_number}}</strong><br>
                                         Country: <strong>{{$shipping->country}}</strong><br>
                                         Address: <strong>{{$shipping->address}}</strong><br>
                                         State: <strong>{{$shipping->state}}</strong><br>
                                         city: <strong>{{$shipping->city}}</strong><br>
                                         zipcode: <strong>{{$shipping->zipcode}}</strong><br>
                                         Country Code: <strong>{{$shipping->country_short_code}}</strong>
                                      </div>
                                     @endif

                                  
                                </td>
                                 
                          </tr>









 @endforeach


