@extends('layouts.vendor')
@section('vendorContents')
<!-- <div class="welcome">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="content">
          <h2>Welcome to Dashboard</h2>
        </div>
      </div>
    </div>
  </div>
</div> -->
<section class="dash-box">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <a href="" class="box-wrap bg1">
                    <span class="c-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </span>
                    <div class="right">
                        <h3>{{ count(getVendorOrdersCount()) }}</h3>
                        <p>Orders</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <a href="" class="box-wrap bg2">
                    <span class="c-icon">
                        <i class="fas fa-user-friends"></i>
                    </span>
                    <div class="right">
                        <h3>{{ count(getVendorBusinessCount()) }}</h3>
                        <p>Business</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <a href="" class="box-wrap bg3">
                    <span class="c-icon">
                        <i class="fas fa-star"></i>
                    </span>
                    <div class="right">
                        <h3>15</h3>
                        <p>Reviews</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
@php
$type_of_package=2;
@endphp
@if(request()->get('type')==2)
  @php
      $type_of_package=1;
  @endphp
@endif
@if($type_of_package==1)
<!-- featured category product start -->
<section class="package-product-sec">
    <div class="container">
        <div class="row mb-30">
            @php
            $packages=DB::table('purchase_package_product')->select('packages.*','purchase_package_product.id as purchase_package_id','purchase_package_product.status as purchase_package_status',DB::raw('CASE WHEN purchase_package_product.status=1 THEN 1 WHEN purchase_package_product.status=2 THEN 2 WHEN purchase_package_product.status=0 THEN 3 END as priority'),'purchase_package_product.start_date as package_purchase_date','purchase_package_product.expiry_date as package_expiry_date')-> join('packages','packages.id','=','purchase_package_product.package_id')->where('packages.type_of_package','=',$type_of_package)->where('user_id',Auth::id())->orderBy('priority','ASC')->get();
            @endphp
            <div class="col-md-12">
                @if(count($packages)>0)
                <h5>Packages Purchased By You</h5>
                @endif
            </div>
            @foreach($packages as $key=>$value)
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 d-flex">
                <div class="package__wrapper card">
                    <div class="">
                        <div class="package {{str_replace(' ','_',$value->title)}}">
                            <div class="package_title">
                                <img src="{{url('wedding_app/public/uploads')}}/{{$value->package_image}}" class="img-fluid" />
                                <h4>{{$value->title}}</h4>
                            </div>
                            <div class="package__wrapper-content">
                                <div class="package_summary">
                                    {!! $value->summary !!}
                                </div>
                                <div class="d-flex justify-content-center" style="font-weight: 700;">
                                      <p ><u>Purchase Date </u> <span style="font-size: 10px">{{Carbon\Carbon::parse($value->package_purchase_date)->format('Y-m-d')}}</span></p>
                                      <p> <u>Expiry Date </u>   <span style="font-size: 10px">{{Carbon\Carbon::parse($value->package_expiry_date)->format('Y-m-d')}}</span></p>
                                </div>
                                
                                <div class="package_type">
                                    @switch($value->purchase_package_status)
                                    @case(1)
                                    <span><button class="btn  btn-success">Active</button></span>
                                    @break
                                    @case(2)
                                    <span><a href="{{$type_of_package==2?route('activate_new_plan_event',$value->purchase_package_id):route('activate_new_plan',$value->purchase_package_id)}}" class="btn  btn-warning">Not Active</a></span>
                                    @break
                                    @case(0)
                                    <span><button class="btn  btn-danger">Validity Finished</button></span>
                                    @break
                                    @default
                                    <span>Something went wrong, please contact with administrator</span>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<hr>
<section class="package-product-sec">
    <div class="container">
    	  @php
            $packages=DB::table('packages')->where('packages.type_of_package','=',$type_of_package)->where('status',1)->orderBy('packages.price','Desc')->get();
            @endphp
        <div class="row">
        	@if(count($packages)>0)
            <div class="col-md-12">
                <h5>Buy any Package and list your particular category product on top</h5>
            </div>
            @endif
            @foreach($packages as $key=>$value)
            <div class="col-lg-3 col-md-3 col-sm-6 col-12 d-flex">
                <div class="package__wrapper card">
                    <div class="package {{str_replace(' ','_',$value->title)}}">
                        <div class="package_title">
                            <img src="{{url('wedding_app/public/uploads')}}/{{$value->package_image}}" class="img-fluid" />
                            <h4>{{$value->title}}</h4>
                        </div>
                        <div class="package__wrapper-content">
                            <div class="package_summary">
                                {!! $value->summary !!}
                            </div>
                            <div class="d-flex justify-content-center" style="font-weight: 700;">
                                <div class="package-validity">
                                    <div class="package_validity">
                                        @switch($value->package_validity_type)
                                        @case(1)
                                        <span> {{$value->package_validity}} @if($value->package_validity==1) Day @else Days @endif</span>
                                        @break
                                        @case(2)
                                        <span> {{$value->package_validity}} @if($value->package_validity==1) Month @else Months @endif</span>
                                        @break
                                        @case(3)
                                        <span> {{$value->package_validity}} @if($value->package_validity==1) Year @else Years @endif</span>
                                        @break
                                        @default
                                        <span>Something went wrong, please try again</span>
                                        @endswitch
                                    </div>
                                </div>
                                <div class="package_price">
                                    <span>&nbsp;/&nbsp;</span> {{$value->price}}$
                                </div>
                            </div>
                            @if($type_of_package==1)
                            <div class="number_of_catgories">
                                <div class="caetgory_in_top">Any {{$value->category_count}} Category </div>
                            </div>
                            @endif
                            <div class="buy_package">
                                <form action="{{$type_of_package==2?url(route('featured_package_purchase_event',$value->id)):url(route('featured_package_purchase',$value->id))}}" method="POST">
                                    <?php 
  $stripe = SripeAccount();  ?>
                                    @csrf
                                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button new-main-button" data-key="{{$stripe['pk']}}" data-amount="{{$value->price * 100}}" data-name="Envision" data-class="Envision" data-description="Shopping" data-email="{{Auth::user()->email}}" data-locale="auto" data-label="Buy Now">
                                    </script>
                                    <script>
                                        $(".stripe-button-el").hide();
    </script>
                                    <input type="hidden" name="price" value="{{$value->price}}">
                                    <button type="submit" class="btn btn-success">Buy Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>	
</section>
@endif
<!-- featured category product end  -->
<section class="latest-rev-test">
    <div class="container">
        <div class="row mb-30">
            <div class="col-sm-12 col-xs-12">
                <div class="w-box">
                    <div class="event-card-head j-c-s-b">
                        <h3>Order Chart</h3>
                    </div>
                    <div id="line-chart" style="height: 400px; width: 100%"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@php
$year = date('Y');
$array = getVendorOrders($year);
@endphp
@endsection
@section('scripts')
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
var ar = <?php echo json_encode($array) ?>;
var y = "<?php echo $year; ?>";
var chart = new Highcharts.Chart({
    chart: {
        renderTo: 'line-chart',
        marginBottom: 90
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        labels: {
            rotation: 90
        },
        title: {
            text: 'Months(' + y + ')'
        }
    },
    yAxis: {
        title: {
            text: 'No. of Orders'
        }
    },
    title: {
        text: 'Order Chart'
    },
    series: [{
        data: ar
    }]
});
</script>
@endsection