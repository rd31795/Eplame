@extends('users.layouts.layout') 
@section('content')

<div class="container-fluid">

 <div class="page_head-card">
    <div class="page-info">
            <div class="page-header-title">
                <h3 class="m-b-10">{{$title}}</h3>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('vendor_dashboard') }}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                <li class="breadcrumb-item">Dispute</li>
            </ul>
   </div>
     
</div>

    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
           <div class="card-header"><h3>{{$title}}</h3></div>
           <div class="card-body">
            <form method="post" id="chatForm" enctype="multipart/form-data">
            @csrf
		      <div class="container-fluid">
		        <div id="messages_container" class="chat-log">
		       
		          <input type="hidden" name="dispute_id" value="{{$dispute->id}}">
		          @if($dispute->raised_by == Auth::user()->id)
		           <div class="chat-log_item chat-log_item-own z-depth-0">
		            <div class="row justify-content-end mx-1 d-flex">
		              <div class="col-auto px-0">
		                <span class="chat-log_author">
		              @php $userName = getUser($dispute->raised_by)  @endphp
		                  <b>{{$userName->name}} </b>
		                </span>
		              </div>
		              <div class="col-auto px-0">
		              </div>
		            </div>
		            <hr class="my-1 py-0 col-8" style="opacity: 0.5">
		            <div class="chat-log_message">
		            	@php $disReason = getReason($dispute->reason)  @endphp
		            	@if(!empty($disReason))
		              <p>Reason - {{$disReason->reasons}}</p>
		              @else
		              <p>Reason - {{$dispute->otherReason}}</p>
		              @endif
		              <p>Amount - {{$dispute->amount}}</p>
		              <p>Proposed solution - {{$dispute->solution}} </p>
		              
		            </div>
		          </div>
		     	 @else
		     	 <div class="chat-log_item chat-log_item z-depth-0">
		            <div class="row justify-content-end mx-1 d-flex">
		              <div class="col-auto px-0">
		                <span class="chat-log_author">
		              @php $userName = getUser($dispute->raised_by)  @endphp
		                  <b>{{$userName->name}} </b>
		                </span>
		              </div>
		              <div class="col-auto px-0">
		              </div>
		            </div>
		            <hr class="my-1 py-0 col-8" style="opacity: 0.5">
		            <div class="chat-log_message">
		              @php $disReason = getReason($dispute->reason)  @endphp
		              <@if(!empty($disReason))
		              <p>Reason - {{$disReason->reasons}}</p>
		              @else
		              <p>Reason - {{$dispute->otherReason}}</p>
		              @endif
		              <p>Amount - {{$dispute->amount}}</p>
		              <p>Proposed solution - {{$dispute->solution}} </p>
		            </div>
		          </div>
		     	@endif
		     	   @php 
		     	       $dispute_again=App\Models\UserDispute::whereOrderId($dispute->order_id)->whereRaisedBy($dispute->raised_by)->whereBusinessId($dispute->business_id)->get();

		     	   @endphp
		           @if(!empty($chats))
		          @foreach($chats as $chat)
		          @if($chat->user_id == Auth::user()->id)
		          <div class="chat-log_item chat-log_item-own z-depth-0">
		            <div class="row justify-content-end mx-1 d-flex">
		              <div class="col-auto px-0">
		                <span class="chat-log_author">
		                   @php $userName = getUser($chat->user_id)  @endphp
		                  <b>{{$userName->name}} </b>
		                </span>
		              </div>
		              <div class="col-auto px-0">
		              </div>
		            </div>
		            <hr class="my-1 py-0 col-8" style="opacity: 0.5">
		            <div class="chat-log_message">
		              <p>{{$chat->chat}} </p>
		            </div>
		          </div>
		          @else
		           <div class="chat-log_item chat-log_item z-depth-0">
		            <div class="row justify-content-end mx-1 d-flex">
		              <div class="col-auto px-0">
		                <span class="chat-log_author">
		              @php $userName = getUser($chat->user_id)  @endphp
		                  <b>{{$userName->name}} </b>
		                </span>
		              </div>
		              <div class="col-auto px-0">
		              </div>
		            </div>
		            <hr class="my-1 py-0 col-8" style="opacity: 0.5">
		            <div class="chat-log_message">
		              <p>{{$chat->chat}}
		              </p>
		            </div>
		          </div>
		          @endif
		          @endforeach
		          @endif
		        </div>
		      </div>
		        @if($dispute->dispute_status == '1' || $dispute->dispute_status == '3')
		    <div class="card-footer border-0 bottom-rounded z-depth-0" style="background-color: #36496c">
		      <div class="row">
		        <div class="col col-md-12 col-lg-12 ">
		          <div class="row d-flex justify-content-center">
		            <div class="col-12 col-md-8 align-self-center my-0">
		              <div class="row d-flex align-self-center ">
		                <div class="col-10 d-flex">
		                  <div class="form-group col-12 my-0 mx-0">
		                    <textarea rows="2" id="content" name="content" placeholder="Write your message*" class="form-control textarea resize-ta"></textarea>
		                  </div>
		                </div>
		              </div>
		            </div>
		          
		            <div class="col-12 col-md-4 d-flex align-self-center justify-content-center justify-content-md-end my-0">
		              <div class="md-form my-1">
		              <button onClick="scrollDown()" type="submit" class="btn btn-primary" name="send" value="send">Send</button>
		              </div>
		               <div class="md-form my-1">
		              <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to connect to Admin')">Connect to Admin</button>
		              </div>
		              @if($dispute->raised_by == Auth::user()->id )
		              <div class="md-form my-1">
		              <button type="submit" class="btn btn-success" name="satisfied" value="satisfied" style="background: #28a745; border-color: #28a745;" onclick="return confirm('Are you satisfied ?')">Satisfied</button>
		              </div>
		              @endif
		              @if($dispute->dispute_status == '3')

		              @else
			              @if(!empty($dispute->vendor_amount))
			              <div class="md-form my-1">
			              <button type="submit" class="btn btn-secondary" name="agreed" value="agreed" data-toggle="tooltip" data-placement="top" title="You ready to negotiable with the given amount by the vendor."
                          onclick="return confirm('Are you sure to negotiate with the given amount by the vendor ?')"
			              >Agreed</button>
			              </div>
			              @endif
		              @endif
		            </div>
		          
		          </div>
		        </div>
		      </div>
		    </div>
		     @endif
			</form>
			</div>
  		</div>
	</div>        
</div>   
@endsection
@section('scripts')
<style>
.error{
	font-weight: 900 !important;
    margin-left: 14px;
}

</style>
<script>
	var messageBody = document.querySelector('#messages_container');
messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
</script>
<script type="text/javascript">
//   function scrollDown() {
//   $('#messages_container').animate({scrollTop:$('#messages_container').prop('scrollHeight')}, 1000);
// }
//   $(document).ready(function(){
//   $("#faq-accordion").on("hide.bs.collapse show.bs.collapse", e => {
//     $(e.target).prev().find("i:last-child").toggleClass("fa-minus fa-plus");
//   });
//   });    


// $("#chatForm").validate({
//   rules: {
//      content:{
//       required: true
//     },
   
//   },
// });
</script>

@endsection
