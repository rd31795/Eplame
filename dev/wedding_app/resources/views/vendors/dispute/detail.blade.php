@extends('layouts.vendor')
@section('vendorContents')
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
@include('vendors.errors')

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
		              @if(!empty($disReason))
		              <p>Reason - {{$disReason->reasons}}</p>
		              @else
		              <p>Reason - {{$dispute->otherReason}}</p>
		              @endif
		              <p>Amount - {{$dispute->amount}}</p>
		              <p>Proposed solution - {{$dispute->solution}} </p>
		            </div>
		          </div>
		     	@endif
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
		              <p>{{$chat->chat}}</p>
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
		       @if($dispute->dispute_status	 == '1' || $dispute->dispute_status == '3')
		    <div class="card-footer border-0 bottom-rounded z-depth-0" style="background-color: #36496c">
		      <div class="row">
		        <div class="col col-md-12 col-lg-12 ">
		          <div class="row d-flex justify-content-center">
		            <div class="col-12 col-md-7 align-self-center my-0">
		              <div class="row d-flex align-self-center ">
		                <div class="col-12 d-flex">
		                  <div class="form-group col-12 my-0 mx-0">
		                    <textarea rows="2" id="content" name="content" placeholder="Write your message*" class="form-control textarea resize-ta"></textarea>
		                  </div>
		                </div>
		              </div>
		            </div>
		            <div class="col-12 col-md-5 d-flex align-self-center justify-content-center my-0">
		              <div class="md-form my-1">
		              <button onClick="scrollDown()" type="submit" class="btn btn-primary connect-to-admin-btn" name="send" value="send" >Send</button>
		              </div>
		               <div class="md-form my-1 three-btns-vndr">
		              <button type="submit" class="btn btn-warning "  onclick="return confirm('Are you sure you want to connect to Admin')" > Connect to Admin</button>
		              </div>
		             
		             <!--  <div class="md-form my-1">
		             <button type="submit" class="btn btn-success" name="satisfied" value="satisfied" style="background: #28a745; border-color: #28a745;">Satisfied</button>
		              </div> -->
                  <div class="md-form my-1">
                 <a href="javascript:void(0);" data-dispute_id="{{$dispute->id}}" class="btn btn-success submit-btn" data-toggle="modal" data-target="#raise-amount" onclick="return confirm('Are you sure you want to return amount')">Amount</a>
                  </div>
		           
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
<div id="raise-amount" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Amount</h4>
            <button type="button" class="close review-close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body" id="modal_body">
           <div class="alert alert-success dispute-success" role="alert" style="display: none;">
            <p>Amount has been submitted Successfully!!</p>
          </div>
           <div class="alert alert-warning dispute-failed" role="alert" style="display: none;">
            <p>Something went wrong</p>
          </div>
            <form id="amountForm" enctype="multipart/formdata">
              @csrf
              <input type="hidden" name="dispute_id" id="dispute-id">
              <div class="form-group">
                <label>Amount* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="How much amount do you want to refund to user?."></i></label>
               <span class="amount-dollar">$</span><input type="text" class="form-control" id="amount" name="amount" placeholder="Amount*" >
              </div>
                
              <div class="form-group">
                <button class="cstm-btn solid-btn" id="amountFormBtn" type="submit">Submit</button>
              </div>
            </form>
         </div>
      </div>
   </div>
</div> 
@endsection
@section('scripts')
<style>
.connect-to-admin-btn {
    background-color: #04a9f5;
    border-color: #04a9f5;
}
.three-btns-vndr {
    margin: 0 5px;
}
span.amount-dollar {
    position: absolute;
    top: 40%;
    left: 2px;
    transform: translate);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 10px;
    background: #35486b;
    color: #fff;
    border-top-left-radius: 2px;
    border-bottom-left-radius: 2px;
    font-size: 14px;
}
#amountForm input {
    padding-left: 35px;
}
.error{
	font-weight: 900 !important;
    margin-left: 14px;
}

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

</script>
<script>
  $('.submit-btn').click(function(){

  var dispute_id = $(this).data('dispute_id');
  $('#amountForm').find('#dispute-id').val(dispute_id);
  
});

$("#amountForm").validate({
  rules: {
     amount:{
      required: true,
      digits: true
    },
   
  },
});
  $('#amountFormBtn').click(function(){
    $(this).attr('disabled', true);
    
    if($('#amountForm').valid()){

        $('#amountForm').submit();
    }else{
        $(this).attr('disabled', false);
        return false;
    }   
});

function amountForm($this) {
  var form = $('body').find('#amountForm')[0]; // You need to use standard javascript object here
  var formData = new FormData(form);

  $.ajax({
      url : "<?= url(route('vendor.dispute.amount')) ?>",
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
        if(data.status=='1')
        {
          $('.dispute-success').css('display', 'block').fadeIn().delay(3000).fadeOut();
          window.location.href = data.redirect_links;
          return true;

        }else{
          $('.dispute-failed').css('display', 'block').fadeIn().delay(3000).fadeOut();
        }
       
      }
  });
}

$("body").on('submit','#amountForm',function(e){
    e.preventDefault();
    amountForm($(this));
});

// $("#chatForm").validate({
//   rules: {
//      content:{
//       required: true
//     },
   
//   },
// });
</script>

@endsection
