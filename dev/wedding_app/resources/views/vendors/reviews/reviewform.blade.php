@extends('layouts.home')
@section('content')

<section class="main-banner cust-banner-height" style="background:url('{{url('/')}}/frontend/images/banner-bg.png');">
    <div class="container">
        <div class="banner-content event-top">
            <h1>Review Form</h1>
        </div>
    </div>
</section>

<section class="services-tab-sec">
    <div class="container">
        <div class="sec-card">
        	@if(Auth::user())
        		@if(Auth::user()->id == $order->user_id)
					<form id="reviewForm" class="review-form-page" enctype="multipart/formdata">
				      @csrf
				       <h3>Rating</h3>
				      <div class="form-group">
				       
				        <div class="star-rating">
				          <input id="star-5" type="radio" name="rating" value="5" checked />
				          <label for="star-5" title="5 stars">
				            <i class="active fa fa-star" aria-hidden="true"></i>
				          </label>
				          <input id="star-4" type="radio" name="rating" value="4" />
				          <label for="star-4" title="4 stars">
				            <i class="active fa fa-star" aria-hidden="true"></i>
				          </label>
				          <input id="star-3" type="radio" name="rating" value="3" />
				          <label for="star-3" title="3 stars">
				            <i class="active fa fa-star" aria-hidden="true"></i>
				          </label>
				          <input id="star-2" type="radio" name="rating" value="2" />
				          <label for="star-2" title="2 stars">
				            <i class="active fa fa-star" aria-hidden="true"></i>
				          </label>
				          <input id="star-1" type="radio" name="rating" value="1" />
				          <label for="star-1" title="1 star">
				            <i class="active fa fa-star" aria-hidden="true"></i>
				          </label>
				        </div>
				      </div>
				      <div class="form-group">
				        <input type="text" name="title" class="form-control" placeholder="Title*">
				      </div>
				      <div class="form-group">
				        <div class="upload-custom">
				          <input type="file" name="image" accept="image/*">
				        </div>
				      </div>
				      <input type="hidden" value="{{$order->id}}" name="order_id" id="order-id">
				      <div class="form-group">
				        <textarea class="form-control" name="reason" placeholder="Reason*"></textarea>
				      </div>
				      <div class="form-group">
				        <button class="cstm-btn solid-btn" id="reviewFormBtn" type="submit">Submit</button>
				      </div>
				    </form>
				@else
					<p> You are not authorised to submit review.</p>
				@endif
			@endif
		</div>
	</div>
</section>
@endsection
@section('scripts')

<script>

$("#reviewForm").validate({
  rules: {
    rating: {
      required: true
    },
    title:{
      required: true,
      minlength: 2,
      maxlength: 30
    },
    reason:{
      required: true,
      minlength: 10,
      maxlength: 250
    }
  },
});

$('#reviewFormBtn').click(function(){
    $(this).attr('disabled', true);
    if($('#reviewForm').valid()){
        $('#reviewForm').submit();
    }else{
        $(this).attr('disabled', false);
        return false;
    }   
});

function reviewForm($this) {
  var form = $('body').find('#reviewForm')[0]; // You need to use standard javascript object here
  var formData = new FormData(form);
  $.ajax({
      url : "<?= url(route('review_submit')) ?>",
      method:"POST",
      data:formData,
      dataType:'JSON',
      contentType: false,
      cache: false,
      processData: false,
      headers: {
       'X-CSRF-TOKEN': $('input[name=_token]').val()
      },
      success: function (data) {
        var thanks_url = "<?= url(route('review.thanks')) ?>";
        window.location.href = thanks_url;
      }
  });
}

$("body").on('submit','#reviewForm',function(e){
    e.preventDefault();
    reviewForm($(this));
});
</script>
@endsection
