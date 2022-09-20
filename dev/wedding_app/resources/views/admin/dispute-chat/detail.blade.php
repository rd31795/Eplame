@extends('layouts.admin')

 
 
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Disputes</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url(route('admin_dashboard'))}}"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item">Disputes</li>
                </ul>
            </div>
        </div>
    </div>
</div>


    <div class="row">
       <div class="col-lg-12">
          <div class="card vendor-dash-card">
          	<form method="post" id="chatForm" enctype="multipart/form-data">
            @csrf
           <div class="card-header"><h3>{{$title}}</h3> <button onClick="scrollDown()" type="submit" name="close" value="close" class="btn btn-success" style="background: #28a745; border-color: #28a745;">Mark as Close</button></div>

           <div class="card-body">
            
		      <div class="container-fluid">
		        <div id="messages_container" class="chat-log">
		       
		          <input type="hidden" name="dispute_id" value="{{$dispute->id}}">
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
		              @if(!empty($disReason))
		              <p>Reason - {{$disReason->reasons}}</p>
		              @else
		              <p>Reason - {{$dispute->otherReason}}</p>
		              @endif
		              <p>Amount - {{$dispute->amount}}</p>
		              <p>Proposed solution - {{$dispute->solution}} </p>
		            </div>
		          </div>
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
		            <div class="col-12 col-md-9 align-self-center my-0">
		              <div class="row">
		                <div class="col-12">
		                  <div class="form-group col-12 my-0 mx-0">
		                    <textarea rows="2" id="content" name="content" placeholder="Write your message*" class="form-control textarea resize-ta"></textarea>
		                  </div>
		                </div>
		              </div>
		            </div>
		         
		            <div class="col-12 col-md-3 d-flex align-self-center justify-content-center  my-0">
		            	
		              <div class="md-form my-1">
		              <button onClick="scrollDown()" type="submit" name="send" value="send" class="btn btn-primary">Send</button>
		              </div>
		              @if($dispute->admin_status == '1')
		              <div class="md-form my-1">
		              <button onClick="scrollDown()" type="submit" name="approved" value="approved" class="btn btn-success" style="background: #28a745; border-color: #28a745;">Approve Request</button>
		              </div>
		              <div class="md-form my-1">
		              <button onClick="scrollDown()" type="submit" name="decline" value="decline" class="btn btn-danger">Decline</button>
		              </div>
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
.vendor-dash-card .card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.error{
	font-weight: 900 !important;
    margin-left: 14px;
}
    
/*body{
  width:100vw;
  height:100vh;
  background-color:#efefff;
}*/

</style>

<script type="text/javascript">
	var messageBody = document.querySelector('#messages_container');
messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
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
