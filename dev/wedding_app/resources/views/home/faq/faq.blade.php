@extends('layouts.home')

@section('title') Faq @endsection
@section('description') Faq @endsection
@section('keywords') Faq @endsection

@section('content')
<section class="log-sign-banner" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="page-title text-center">
            <h1>faq</h1>
        </div>
    </div>    
</section>
 <section class="faq-sec"> 
 	<div class="container"> 
 		<div class="sec-card"> 
	      <div class="faq-content"> 
	      	<div class="sec-heading dark-sec-heading text-center">
         <h2>Frequently Asked Questions</h2>
      </div>
  <div class="faq-tab-wrap">
  <ul class="nav nav-tabs faq-tabs" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" data-val="vendor-faqs"><span class="tab-icon"><img src="{{url('/frontend/images/user-img.png')}}"></span> User</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#tabs-1" role="tab" data-val="user-faqs"><span class="tab-icon"><img src="{{url('/frontend/images/user-img.png')}}"></span> Vendor</a>
	</li>
</ul><!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane active" id="tabs-1" role="tabpanel">
        <div class="faq-acc-wrap">
        	<div id="faq-pg-accordion" class="faq-pg-accordion">
        	 <div class="row">

        	
        	@foreach($faqs as $key => $faq)

        		@if($faq->type === 'user')
	        	<div class="col-lg-12 user-faqs">
				  <div class="card">
				    <div class="card-header" id="heading-user-{{$faq->id}}">
				      <h2 class="mb-0">
				        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-user-{{$faq->id}}" aria-expanded="false" aria-controls="collapse-user-{{$faq->id}}">
				          {{ $faq->question }}
				          <span class="fa-stack fa-2x">
				              <i class="fas fa-circle fa-stack-2x"></i>
				            <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
				          </span>
				        </button>
				      </h2>
				    </div>
				    <div id="collapse-user-{{$faq->id}}" class="collapse" aria-labelledby="heading-user-{{$faq->id}}" data-parent="#faq-pg-accordion">
				      <div class="card-body">
				          {!! $faq->answer !!}
				      </div>
				    </div>
				  </div>
				</div>
				@endif
				
        	 	@if($faq->type === 'vendor')
	 
	         <div class="col-lg-12 vendor-faqs" style="display: none;">
				  <div class="card">
				    <div class="card-header" id="heading-vendor-{{$faq->id}}">
				      <h2 class="mb-0">
				        <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapse-vendor-{{$faq->id}}" aria-expanded="false" aria-controls="collapse-vendor-{{$faq->id}}">
				          {{ $faq->question }}
				          <span class="fa-stack fa-2x">
				              <i class="fas fa-circle fa-stack-2x"></i>
				            <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
				          </span>
				        </button>
				      </h2>
				    </div>
				    <div id="collapse-vendor-{{$faq->id}}" class="collapse" aria-labelledby="heading-vendor-{{$faq->id}}" data-parent="#faq-pg-accordion">
				      <div class="card-body">
				          {!! $faq->answer !!}
				      </div>
				    </div>
				  </div>
				</div>


				@endif	
	        	
			@endforeach

		   </div>
			</div>
        </div> <!-- faq-acc-wrap -->

        	</div>
	<div class="tab-pane" id="tabs-2" role="tabpanel">
		 <div class="faq-acc-wrap">
        	<div id="faq-vendor-accordion" class="faq-pg-accordion">
        	 <div class="row">

			@foreach($faqs as $key => $faq)
	       		
			@endforeach

		   </div>
			</div>
        </div> <!-- faq-acc-wrap -->
	</div>
</div>


	  </div>
	</div>
     </div>
    </div>
</section>


@endsection

@section('scripts')
<script type="text/javascript">
	$("#faq-pg-accordion").on("hide.bs.collapse show.bs.collapse", e => {
  $(e.target)
    .prev()
    .find("i:last-child")
    .toggleClass("fa-minus fa-plus");
});


 $("body").on('click','a.nav-link',function(){
 	var $this = $(this);
 	if($this.data('val') == "vendor-faqs"){
 		$("body").find('.vendor-faqs').show();
 		$("body").find('.user-faqs').hide();
 	}else{
 		$("body").find('.vendor-faqs').hide();
 		$("body").find('.user-faqs').show();
 	}
(".collapse").collapse();
 	setTimeout(function(){
	   $("#faq-pg-accordion").on("hide.bs.collapse show.bs.collapse", e => {
		  $(e.target)
		    .prev()
		    .find("i:last-child")
		    .toggleClass("fa-minus fa-plus");
		});
	},3000);
	});
</script>
@endsection
