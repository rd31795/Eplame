<section class="products-sec">
    <div class="container">
        <div class="sec-heading wow bounceInRight cs-after-remove" data-wow-delay=".35s">
            <div class="d-flex justify-content-between">
                <h2>Top Seller</h2>
                <a href="https://eplame.com/dev/shop/" class="cstm-btn">view all</a>
            </div>
        </div>
        <div class="product-wrapper wow bounceInUp" data-wow-delay=".40s">
             <!-- slider -->
            <div class="owl-carousel owl-theme popular-product-slider">
                 <!--    <div class="product-card">
                        <div class="badge">On Sale</div>
                        <a href="https://eplame.com/dev/shop/product/color-block-men-hooded-neck-red-white-blue-t-shirt" class="product-tumb">
                            <img src="https://eplame.com/dev/images/products/1581088157xa6JG2iZTEMaCR4WrqIsm61ywnleweloriginalimafgxd7dfg7uub2.jpeg" alt="">
                        </a>
                        <div class="product-details">
                            <a href="https://eplame.com/dev/shop/product/color-block-men-hooded-neck-red-white-blue-t-shirt">
                                <h4>Color Block Men Hooded Neck Red, White, Blue T-Shirt</h4>
                                <p>Color Block Men Hooded Neck Red, White, Blue T-Shirt</p>
                            </a>
                            <div class="product-bottom-details">
                                <h5>Price Start From</h5>
                                <div class="product-price"><small>$700.00</small>$550.00</div>
                                <div class="product-links">
                                    <a href="javascript:void(0)" class="wishlist " data-url="https://eplame.com/dev/shop/ajax/wishlist/34"><i class="fa fa-heart"></i>
                                    </a>
                                    <a href="https://eplame.com/dev/shop/product/color-block-men-hooded-neck-red-white-blue-t-shirt"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <?php
                    $cart=\App\Models\Shop\ShopCartItems::select('product_id',DB::raw('count(product_id) as orders'))->whereType('order')->groupBY('product_id')->orderBy('orders','Desc')->take(20)->get();
                ?>
                @foreach($cart as $top_seller)
                <?php
                    $pro=$top_seller->product;
                    $product = $pro->parent > 0 ? $pro->getParentProductData : $pro;
                    $complete1 = $product->ProductAssignedVariations != null && $product->ProductAssignedVariations->count() > 0 ? 1 : 0;
                    $RS =   $product->subProducts != null && $product->subProducts->count() > 0 ? $product->subProducts->first() : $product;
                    $complete2 = $product->product_type == 0 && $product->price > 0 ? 1 : 0;
                    $complete = $product->product_type == 0 ? $complete2 : $complete1;
                    $saleImage = $RS->sale_price > 0 ? 'On Sale' : 'Hot';
                    $type = $complete == 0 ? 'Comming Soon' : $saleImage;
                    $url = $complete == 1 ? url(route('shop.product.detail.page',$RS->slug)) : 'javascript:void(0)';
                    $stock = $pro->parent > 0 ? $pro->checkStock() : $product->checkStock();
                  ?>
                <div class="item">
                    <div class="product-card">
                        {!!checkInStock($stock)!!}
                        <div class="badge">{!!$type!!}</div>
                        <a href="{{$url}}" class="product-tumb">
                            <img src="{{$RS->thumbnail != null ? url($RS->thumbnail) : ''}}" alt="">
                        </a>
                        <div class="product-details">
                            <a href="{{$url}}">
                                <h4>{{$product->name}}</h4>
                                <p>{{$product->short_description}}</p>
                            </a>
                            <div class="product-bottom-details">
                                <h5>Price Start From</h5>
                                @php $price = $RS->productPrice(); @endphp
                                {!!$price['html']!!}
                                <div class="product-links">
                                    <a href="javascript:void(0)" class="wishlist {{$product->hasInWishlist()}}" data-url="{{url(route('shop.wishlist.create',$product->id))}}"><i class="fa fa-heart"></i>
                                    </a>
                                    <a href="{{$url}}"><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>