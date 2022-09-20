@extends('layouts.admin')
@section('content')

<section class="dash-box"> 
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="{{route('admin.orders')}}" class="box-wrap bg1">
						<span class="c-icon">
							<i class="fas fa-shopping-cart"></i>
						</span>
					<div class="right">
						<h3>{{count(getStatOrders())}}</h3>
						<p>Orders</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="{{route('list_users')}}" class="box-wrap bg2">
						<span class="c-icon">
							<i class="fas fa-user-friends"></i>
						</span>
					<div class="right">
						<h3>{{count(getStatUsers())}}</h3>
						<p>Users</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="{{route('list_reviews')}}" class="box-wrap bg3">
						<span class="c-icon">
							<i class="fas fa-star"></i>
						</span>
					<div class="right">
						<h3>{{count(getStatReviews())}}</h3>
						<p>Reviews</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="{{route('list_testimonials')}}" class="box-wrap bg6">
						<span class="c-icon">
							<i class="fas fa-quote-right"></i>
						</span>
					<div class="right">
						<h3>{{count(getStatTestimonials())}}</h3>
						<p>Testimonials</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="{{route('list_vendors')}}" class="box-wrap bg5">
						<span class="c-icon">
							<i class="fas fa-user"></i>
						</span>
					<div class="right">
						<h3>{{count(getStatVendors())}}</h3>
						<p>Vendors</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="{{route('admin.business.index')}}" class="box-wrap bg4">
						<span class="c-icon">
							<i class="fas fa-clipboard-list"></i>
						</span>
					<div class="right">
						<h3>{{count(getStatBusiness())}}</h3>
						<p>Active Business</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="{{route('admin.dispute-chat.index')}}" class="box-wrap bg2">
						<span class="c-icon">
							<i class="fas fa-clipboard-list"></i>
						</span>
					<div class="right">
						<h3>{{count(getStatUserDisputes())}}</h3>
						<p>Total Disputes</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="javascript:void(0)" class="box-wrap bg1">
						<span class="c-icon">
							<i class="fas fa-clipboard-list"></i>
						</span>
					<div class="right">
						<h3>${{ getStatSumOrders() }}</h3>
						<p>Total Expenses</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="javascript:void(0)" class="box-wrap bg3">
						<span class="c-icon">
							<i class="fas fa-clipboard-list"></i>
						</span>
					<div class="right">
						<h3>{{count(getStatEvents())}}</h3>
						<p>Total Events Hosted</p>
					</div>
				</a>
			</div>
			
		</div>
	</div>
</section>

<section class="dash-box"> 
	<div class="container">
		
			<div class="head-pending-tasks cust-pend">
              <h3> Pending Tasks </h3>
            </div>
            <div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="{{route('admin.vendor.list')}}" class="box-wrap bg1">
						<span class="c-icon">
							<i class="fas fa-user"></i>
						</span>
					<div class="right">
						<h3>{{count(getNewVendors())}}</h3>
						<p>New Vendors</p>
					</div>
				</a>
			</div>

			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="{{route('list_reviews')}}" class="box-wrap bg2">
						<span class="c-icon">
							<i class="fas fa-star"></i>
						</span>
					<div class="right">
						<h3>{{count(getPendingReviews())}}</h3>
						<p>New Reviews</p>
					</div>
				</a>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<a href="{{route('admin.dispute-chat.index')}}" class="box-wrap bg5">
						<span class="c-icon">
							<i class="fas fa-user"></i>
						</span>
					<div class="right">
						<h3>{{count(getStatAdminStatus())}}</h3>
						<p>Pending Disputes</p>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>

<section class="latest-rev-test">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<div class="w-box">
					<div class="event-card-head j-c-s-b">
	                  <h3> Latest Reviews </h3>
	               </div>
					<ul>
						@php $reviews = getStatReviews()->take(5); @endphp
						@if(!empty($reviews[0]->id))
							@foreach($reviews as $review)
								<li>
									<figure>
										@if(!empty($review->businessreviewUserId->profile_image))
		                                  <img src="{{asset('').'/'.$review->businessreviewUserId->profile_image}}" title="{{$review->businessreviewUserId->name}}">
		                                @else
		                                  <img src="{{url('/')}}/images/faceless.jpg" title="{{$review->businessreviewUserId->name}}">
		                                @endif
									</figure>
									<div class="cust-star-rate">
									@for($i = 0; $i < 5; $i++)

		                              <span class="btn @if($i<$review->rating) btn-warning @else btn-default btn-grey @endif btn-xs" aria-label="Left Align">
		                                <span class="fas fa-star" aria-hidden="true"></span>
		                              </span>

		                            @endfor

										<a href="{{ route('edit_review', $review->id) }}">
											<h3>{{$review->title}}</h3>
										</a>
								   
								         </div>
								</li>
							@endforeach
						@endif
					</ul>
					<a href="{{route('list_reviews')}}" class="cstm-btn solid-btn">View More</a>
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="w-box">
					<div class="event-card-head j-c-s-b">
	                  <h3> Testimonials </h3>
	                </div>
					<ul>
						@php $testimonials = getStatTestimonials()->take(5); @endphp
						@if(!empty($testimonials[0]->id))
							@foreach($testimonials as $testimonial)
							<li>
								<figure>
									<img src="{{url('/')}}/wedding_app/public/uploads/{{$testimonial->image}}">
								</figure>
								<span>
									<a href="{{ route('edit_testimonial', $testimonial->id) }}"><h3>{{$testimonial->title}}</h3></a>
									<p>{{ strlen($testimonial->summary)<=100 ? $testimonial->summary : substr($testimonial->summary,0,100).'...' }}</p>
							    </span>
							</li>
							@endforeach
						@endif
					</ul>	
					<a href="{{route('list_testimonials')}}" class="cstm-btn solid-btn">View More</a>	
				</div>
			</div>
		</div>
		<div class="row mb-30">
			<div class="col-sm-6 col-xs-12">
				<div class="w-box">
					<div class="event-card-head j-c-s-b">
	                  	<h3> Latest Disputes </h3>
	                </div>
					<ul>
					@php $disputes = getStatDisputes()->take(5); @endphp
					@if(!empty($disputes[0]->id))
						@foreach($disputes as $dispute)
							<li>
								<div class="cust-star-rate">
									<a href="{{ route('admin.vendor.dispute.detail', $dispute->id) }}">
										<h3>{{$dispute->reason}}</h3>
									</a>
									<p>{{ strlen($dispute->summary)<=100 ? $dispute->summary : substr($dispute->summary,0,100).'...' }}</p>
							    </div>
							</li>
						@endforeach
					@endif
					</ul>
					<a href="{{route('admin.vendor.dispute')}}" class="cstm-btn solid-btn">View More</a>
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="w-box">
					<div class="event-card-head j-c-s-b">
	                  	<h3> Latest Business </h3>
	            	</div>
					<ul>
						@php $businesses = getStatBusiness()->take(5); @endphp
						@if(!empty($businesses[0]->id))
							@foreach($businesses as $business)
							<li>
								<figure>
									@if(!empty(getVendorCover($business->category_id, $business->id)))
	                                  <img src="{{asset('').'/'.getVendorCover($business->category_id, $business->id)}}" title="{{$business->title}}">
	                                @else
	                                  <img src="{{url('/')}}/images/faceless.jpg" title="{{$business->title}}">
	                                @endif
								</figure>
								<span>
									<a href="{{ route('vendorBusinessView', ['slug'=> $business->category->slug, 'vendorSlug'=> $business->business_url]) }}">
										<h3>{{$business->title}}</h3>
									</a>
							    </span>
							</li>
							@endforeach
						@endif
					</ul>	
					<a href="{{route('admin.business.index')}}" class="cstm-btn solid-btn">View More</a>
				</div>
			</div>
		</div>
		<div class="row mb-30">
			<div class="col-sm-6 col-xs-12">
				<div class="w-box">
					<div class="event-card-head j-c-s-b">
	                  <h3> Latest Users </h3>
	               </div>
					<ul>
						@php $users = getStatUsers()->take(5); @endphp
						@if(!empty($users[0]->id))
							@foreach($users as $user)
								<li>
									<figure>
										@if(!empty($user->profile_image))
		                                  <img src="{{asset('').'/'.$user->profile_image}}" title="{{$user->name}}">
		                                @else
		                                  <img src="{{url('/')}}/images/faceless.jpg" title="{{$user->name}}">
		                                @endif
									</figure>
									<div class="cust-star-rate">
										<a href="javascript:void(0)">
											<h3>{{$user->name}}</h3>
										</a>
								    </div>
								</li>
							@endforeach
						@endif
					</ul>
					<a href="{{route('list_users')}}" class="cstm-btn solid-btn">View More</a>
				</div>
			</div>
			<div class="col-sm-6 col-xs-12">
				<div class="w-box">
					<div class="event-card-head j-c-s-b">
	                  <h3>Latest Vendors </h3>
	                </div>
					<ul>
						@php $vendors = getStatVendors()->take(5); @endphp
						@if(!empty($vendors[0]->id))
							@foreach($vendors as $vendor)
								<li>
									<figure>
										@if(!empty($vendor->profile_image))
		                                  	<img src="{{asset('').'/'.$vendor->profile_image}}" title="{{$vendor->name}}">
		                                @else
		                                  	<img src="{{url('/')}}/images/faceless.jpg" title="{{$vendor->name}}">
		                                @endif
									</figure>
									<div class="cust-star-rate">
										<a href="{{ route('admin_vendor_business', $vendor->id) }}">
											<h3>{{$vendor->name}}</h3>
										</a>
								    </div>
								</li>
							@endforeach
						@endif
					</ul>	
					<a href="{{route('list_vendors')}}" class="cstm-btn solid-btn">View More</a>	
				</div>
			</div>
		</div>
		<div class="row mb-30">
			<div class="col-sm-6 col-xs-12">
				<div class="w-box">
					<div class="event-card-head j-c-s-b">
	                  <h3> Recent Orders </h3>
	               </div>
					<ul>
						@php $orders = getStatOrders()->take(5); @endphp
						@if(!empty($orders[0]->id))
							@foreach($orders as $order)
								<li>
									<div class="cust-star-rate">
										<a href="{{ route('admin.orderDetail', $order->id)}}">
											<h3>{{$order->orderID}}</h3>
										</a>
								    </div>
								</li>
							@endforeach
						@endif
					</ul>
					<a href="{{route('admin.orders')}}" class="cstm-btn solid-btn">View More</a>
				</div>
			</div>
		</div>
		<div class="row mb-30">
			<div class="col-sm-12 col-xs-12">
				<div class="w-box">
					<div class="event-card-head j-c-s-b">
	                  <h3> Orders </h3>
	               </div>
					<div id="line-chart" style="height: 400px; width: 100%"></div>

				</div>
			</div>
		</div>
		<div class="row mb-30">
			<div class="col-sm-12 col-xs-12">
				<div class="w-box">
					<div class="event-card-head j-c-s-b">
	                  <h3> New Users and Vendors</h3>
	               </div>
					<div id="user-chart" style="height: 400px; width: 100%"></div>

				</div>
			</div>
		</div>
	</div> 
</section>

@php 
	$year = date('Y');
	$array = getOrdersNumbers($year);
	$user_array = getUsersNumbers($year);
	$vendor_array = getVendorsNumbers($year);
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
      text: 'Months('+y+')'
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
  	name: 'Orders',
    data: ar
  }]
});

	var arr = <?php echo json_encode($user_array) ?>;
	var ven_arr = <?php echo json_encode($vendor_array) ?>;
	var y = "<?php echo $year; ?>";
	var chart = new Highcharts.Chart({
  chart: {
    renderTo: 'user-chart',
    marginBottom: 90
  },
  xAxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    labels: {
      rotation: 90
    },
    title: {
      text: 'Months('+y+')'
    }
  },
  yAxis: {
    title: {
      text: 'No. of Users and Vendors'
    }
  },
  title: {
    text: 'Sign-up Chart'
  },
  series: [{
  	name: 'Users',
    data: arr
  },
  {
  	name: 'Vendors',
    data: ven_arr
  }
  ]
});

</script>
@endsection
