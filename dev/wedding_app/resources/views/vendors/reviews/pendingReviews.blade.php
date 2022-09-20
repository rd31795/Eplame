@extends('layouts.vendor')
@section('vendorContents')

<div class="pannel-card">
	@if(!empty($pending_reviews[0]->id))
		<div class="card-heading">
			<h3>Pending</h3>			
		</div>	
		<div class="table-responsive">
			<table class="table pending-order-table">
				<thead>
					<tr>
						<th>Order ID</th>
						<th>User</th>
						<th>Event</th>
						<th>Service</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($pending_reviews as $order)
						@php $eventStatus = EventRunningStatus($order->event_id) @endphp
						@if($eventStatus == 'Past Event')
						<tr>
							<td>
								{{$order->OrderID}}
							</td>
							<td>
								{{$order->user->name}}
							</td>
							<td>
								{{$order->event->title}}
							</td>
							<td>
								{{$order->vendor->title}}
							</td>
							<td>
								<div class="btn-wrap">
									<button class="button req-btn" data-id="{{$order->id}}">Request Review</button>
									
									<button class="button cpy-btn" onclick="copyToClipboard('#p{{$order->id}}')" data-toggle="tooltip" data-placement="top" title="Copy to clipboard">Copy Link
										<span id="p{{$order->id}}" style="visibility: hidden;opacity: 0">{{ route('review_form', $order->id)}} </span>
									</button>
								</div>
							</td>
						</tr>
					@endif
				@endforeach
			</tbody>
		</table>
	</div>
	@else
		<p class="show-p">You do not have any review pending.</p>
	@endif
</div>

@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootbox@5.5.2/bootbox.js"></script>
<script>
	function copyToClipboard(element) {
	  var $temp = $("<input>");
	  $("body").append($temp);
	  $temp.val($(element).text()).select();
	  document.execCommand("copy");
	  $temp.remove();
	  bootbox.alert('link has been copied.');
	}

	jQuery('.req-btn').click(function(){
		var orderid = jQuery(this).data('id');
		jQuery('.custom-loading').css('display','block');
		jQuery.ajax({
		  type:'post',
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  },
	      url : "<?= url(route('review_request')) ?>",
	      data:{ 'orderid' : orderid },
	      success: function (data) {
	      	jQuery('.custom-loading').css('display','none');
	        bootbox.alert(data.messages);
	      }
  		});
	});
</script>
@endsection