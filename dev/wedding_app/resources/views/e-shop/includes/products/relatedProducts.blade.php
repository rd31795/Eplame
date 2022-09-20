 <section class="featured-product-sec related-product-sec">
         <div class="container">
             <div class="sec-heading text-center">
                <h2>RELATED PRODUCTS</h2>
            </div>
            <div class="featured-product-wrap">
                    <div class="owl-carousel owl-theme featured-product-slider">

                           @foreach($relatedProduct as $relatedproduct)
                                <?php
                                //code for making url of related product Old one STARTED
                                                                 $complete1 = $relatedproduct->ProductAssignedVariations != null && $relatedproduct->ProductAssignedVariations->count() > 0 ? 1 : 0;
                                    $complete2 = $relatedproduct->product_type == 0 && $relatedproduct->price > 0 ? 1 : 0;
                                    $complete = $relatedproduct->product_type == 0 ? $complete2 : $complete1;
                                    $type = $complete == 0 ? 'Comming Soon' : 'Hot';
                                    $url = $complete == 1 ? url(route('shop.product.detail.page',$relatedproduct->slug)) :  'javascript:void(0)';

                                    //code for making url of related product new one STARTED
                                    $url=url(route('shop.product.detail.page',$relatedproduct->slug));
                                    $producthasVariant = $relatedproduct->getProductRelatedVariation->last();
                                    if($producthasVariant){
                                      $url=$url.'?'.$producthasVariant->type.'='.$producthasVariant->attribute_id;           }
                                 ?>
                              <a href="{{$url}}" class="item"> 
                                  <div class="featured-product-card">
                                    <figure class="f-product-img">
                                        <img src="{{$relatedproduct->thumbnail != null ? url($relatedproduct->thumbnail) : ''}}">
                                    </figure>
                                     <div class="f-product-detail">
                                         <h4>{{$relatedproduct->name}}</h4>
                                         <div class="f-product-price text-center">
                                             @php $price = $relatedproduct->productPrice(); @endphp
                                                {!!$price['html']!!}
                                         </div>
                                     </div>
                                 </div>
                               </a>

                            @endforeach
                       
                         
                       
                     </div>
                    
                </div>
            
         </div>
     </section>