@extends('e-shop.layouts.layout')
@section('content')

<!-- banner section starts here here -->
{{--
    <section class="inner-main-banner" style="background-image:url({{url('/e-shop/images/product-listing-banner-bg.png')}});">
        <div class="container">
            <div class="inner-banner-content text-center">
                <h1>Products</h1>
            </div>
        </div>
    </section>
    --}}
    <main class="collection-sec ">
        <div class="container">
                      <!-- <div class="products-head">
                        <h3 class="product-list-heading">New Products</h3>
                     </div> -->
            <div class="row">
              @foreach($category as $cat)
               @if($cat->childcategory)
                  <div class="col-lg-3">  
                    <div class="collection-card">
                    <a href=" {{url(route('shop.childcategory',[$cat->category->slug,$cat->subcategory->slug,$cat->childcategory->slug,'type'=>$type]))}}">
                       <figure>
                         <img src="{{url($cat->childcategory->image ?? '')}}">
                         
                       </figure>
                       <div class="collection-card-content">
                           <h5>{{$cat->childcategory->label ?? "Static"}}</h5>
                         </div>
                    </a>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
        </div>
    </main>




  @endsection



@section('jscript')
<script type="text/javascript" src="{{url('/e-shop/js/products/filters.js')}}"></script>
<script type="text/javascript">
  

</script>

@endsection