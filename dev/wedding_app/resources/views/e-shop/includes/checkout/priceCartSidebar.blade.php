 <div class="card cart-total-card">
                                <div class="card-body">
                                    <h3 class="card-title">Cart Totals</h3>
                                    @php
                                      try{
                                       echo $obj->getTotalWithTr();
                                      }catch (\Exception $e) {
                                       echo "<div style='color:red'>Zipcode is not valid</div>";
                                      }
                                    @endphp
                                    <!-- <a class="cstm-btn solid-btn btn-xl btn-block cart__checkout-button" href="checkout.html">Proceed to checkout</a> -->
                                </div>
                            </div>