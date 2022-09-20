@php 
 $mens_product_category = App\Models\Products\ProductCategory::where('status',1)->where('subparent',2)->take(4)->get();
 $womens_product_category=App\Models\Products\ProductCategory::where('status',1)->where('subparent',3)->take(4)->get();
 $laptop_category=App\Models\Products\ProductCategory::where('status',1)->where('subparent',18)->take(4)->get();
@endphp
<style type="text/css">
    .common-category-sec .common-category-inner a {
    display: flex;
    flex-direction: column;
    text-align: center;
}
</style>

<section class="common-category-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="common-category-card">
                    <h5>Styles for Men's | Up to 70% off</h5>
                    <div class="row">
                        @foreach($mens_product_category as $value)
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="common-category-inner">
                                @php
                                  $subcategory=App\Models\Products\ProductCategory::where('id',$value->subparent)->first();
                                  $category=App\Models\Products\ProductCategory::where('id',$value->parent)->first();
                                @endphp
                                <a href="{{url(route('shop.childcategory',[$category->slug,$subcategory->slug,$value->slug]))}}">
                                <figure>
                                    <img src="https://images-eu.ssl-images-amazon.com/images/G/31/img21/Fashion/Event/Gateway/WRS-Jun/PC_QC_186/Comp-186/8-min._SY116_CB666463598_.jpg" alt="" class="img-fluid">
                                </figure>
                                <p>{{$value->label}}</p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="common-category-card">
                    <h5>Laptops & Desktop's | Up to 20% off</h5>
                    <div class="row">
                        @foreach($laptop_category as $value)
                           @php
                                  $subcategory=App\Models\Products\ProductCategory::where('id',$value->subparent)->first();
                                  $category=App\Models\Products\ProductCategory::where('id',$value->parent)->first();
                           @endphp
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="common-category-inner">
                                <a href="{{url(route('shop.childcategory',[$category->slug,$subcategory->slug,$value->slug]))}}">
                                <figure>
                                    <img src="https://images-eu.ssl-images-amazon.com/images/G/31/img21/Fashion/Event/Gateway/WRS-Jun/PC_QC_186/Comp-186/8-min._SY116_CB666463598_.jpg" alt="" class="img-fluid">
                                </figure>
                                <p>{{$value->label}}</p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="common-category-card">
                    <h5>Styles for Women's | Up to 70% off</h5>
                    <div class="row">
                         @foreach($womens_product_category as $value)
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                             @php
                                  $subcategory=App\Models\Products\ProductCategory::where('id',$value->subparent)->first();
                                  $category=App\Models\Products\ProductCategory::where('id',$value->parent)->first();
                             @endphp
                            <div class="common-category-inner">
                                <a href="{{url(route('shop.childcategory',[$category->slug,$subcategory->slug,$value->slug]))}}" class="product_card-outer">
                                <figure>
                                    <img src="https://images-eu.ssl-images-amazon.com/images/G/31/img21/Fashion/Event/Gateway/WRS-Jun/PC_QC_186/Comp-186/8-min._SY116_CB666463598_.jpg" alt="" class="img-fluid">
                                </figure>
                                <p>{{$value->label}}</p>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>