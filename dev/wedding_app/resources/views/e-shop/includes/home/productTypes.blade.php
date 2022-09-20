<style type="text/css">
    .product_card-outer {
        width: 100%;
    }
</style>
<section class="product-type-sec">
    <div class="container">
        <div class="sec-heading text-center wow bounceInRight animated" data-wow-delay=".35s" style="visibility: visible; animation-delay: 0.35s; animation-name: bounceInRight;">
            <h2>PRODUCTS TYPES</h2>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @php 
                      $product_type=\App\Models\Products\ProductType::where('status',1)->take(4)->get();
                    @endphp
                    @foreach($product_type as $key=>$value)
                      <div class="col-md-3 col-sm-6 col-12 d-flex">
                            <a href="{{route('shop.product.product-type',['type'=>$value->slug])}}" class="product_card-outer">
                        <div class="product_card-wrap">
                            <h3>{{strtoupper($value->label)}}</h3>
                            <figure>
                                <img src="{{url($value->image)}}">
                            </figure>
                        </div>
                            </a>
                      </div>
                    @endforeach
                   <!--  <div class="col-md-3 col-sm-6 col-12 d-flex">
                        <div class="product_card-wrap">
                            <h3>NEW PRODUCTS</h3>
                            <figure>
                                <img src="images/testing/image.png">
                            </figure>
                        </div>
                    </div> -->
                    <!-- <div class="col-md-3 col-sm-6 col-12 d-flex">
                        <div class="product_card-wrap">
                            <h3>OLD PRODUCTS</h3>
                            <figure>
                                <img src="https://files.cdn.printful.com/o/upload/variant-image-jpg/22/22c389586bcbbc605bb5fc667bef43d8_l?v=143fbee3598be16660f1b74538e2ed42">
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12 d-flex">
                        <div class="product_card-wrap">
                            <h3>REFURBISHED</h3>
                            <figure>
                                <img src="https://files.cdn.printful.com/o/upload/variant-image-jpg/0c/0c02fa1bea78d4cbaef62535e58c25d8_l">
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12 d-flex">
                        <div class="product_card-wrap">
                            <h3>NEVER USED</h3>
                            <figure>
                                <img src="https://files.cdn.printful.com/o/upload/variant-image-jpg/40/40e7d96f7b8ed82a1774b2cc712e1701_l">
                            </figure>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>