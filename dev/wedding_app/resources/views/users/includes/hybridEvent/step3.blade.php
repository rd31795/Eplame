<style>
  ul.input-group-btn.color-btn.acrdn-action-btns {
    position: absolute;
    right: -14px;
}
.field_wrapper .pick-color-field-wrap .form-control.ColourSelect {
    height: 45px;
}
.limit_exceed{
   color:red;
}
</style>

<form id="thirdEventCreate" enctype="multipart/form-data" action="{{url(route('steps.second'))}}">
   @csrf
   <div class="formFileds">
      <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
               <label class="control-label">Event Style <i class="fas fa-info-circle" data-toggle="tooltip" title="Choose your event style. You can create your own by choosing other in options."></i></label>
               <div class="input-field-wrap">
                  <select class="form-control" id="style_type" name="style_type">
                     <?php $EventStyles = \App\Style::where('status',1)->orderBy('title','ASC')->get(); ?>
                     <option >Select Event Style</option>
                     @foreach($EventStyles as $style)
                     <option value="{{$style->id}}">{{$style->title}}</option>
                     @endforeach
                     <option value="0">Others</option>
                  </select>
               </div>
            </div>
         </div>
         <div class="col-lg-6" id="style-field-1">
            <div class="form-group">
               <label class="control-label">Style Title <i class="fas fa-info-circle" data-toggle="tooltip" title="Style Title!"></i></label>
               <div class="input-field-wrap">
                  <input type="text" class="form-control" name="style_title" id="style_title" placeholder="Style Title">
               </div>
            </div>
         </div>
         <div class="col-md-6" id="style-field-3">
            <div class="form-group ">
               <div class="style-image">
                  <label class="label-file">Style Image<i class="fas fa-info-circle" data-toggle="tooltip" title="Style Image!"></i></label>
                  <input type="file" name="style_image" accept="image/*" id="style_image" class="form-control" onchange="preview()">
               </div>
            </div>
         </div>
         <div class="col-md-6" id="style-field-2">
            <div class="form-group">
               <label class="control-label">Style Description <i class="fas fa-info-circle" data-toggle="tooltip" title="Style Description!"></i></label>
               <div class="input-field-wrap">
                  <textarea class="form-control" id="style_description" name="style_description" rows="5" col="10" spellcheck="false" placeholder="Type Here..."></textarea>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group ">
               <label class="control-label">Colour* <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Theme Colour!"></i></label>
               <input type="hidden" id="countColours" value="1"> 
               <div class="row field_wrapper">
                  <div class="element col-lg-3 col-md-6">
                     <div class="pick-color-field-wrap">
                        <div class="form-group">
                           <input type="color" onchange="GetColour(this)" class="ColorGet" style="width: 46px; margin-left: -2px;" name="colours[]" value="#000" id="event_color_name">
                           <input type="text" onchange="GetColourName(this)" id="event_color_name" value="black" class="form-control ColourSelect" name="colourNames[]" placeholder="Colour Name">
                           <ul class="input-group-btn color-btn acrdn-action-btns cs-plus">
                              <li> <button class="icon-btn add_button action_btn" type="button" style=""><i class="fas fa-plus"></i></button></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            {{choosefile($errors, '<label class="control-label">Event Picture* <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Picture!"></i></label>', 'event_picture')}}
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label class="control-label">Banner Image* <i class="fas fa-info-circle" data-toggle="tooltip" title="Banner Image!"></i></label>
               <input type="file" name="banner_image" accept="image/*" id="banner_image" class="form-control" >
            </div>
         </div>
         <div class="col-md-6">
            <div class="form-group">
               <label class="control-label">Souvenir Store <i class="fas fa-info-circle" data-toggle="tooltip" title="Souvenir Store URL!"></i></label>
               <input type="text" name="souvenir_url" id="souvenir_url" class="form-control" >
            </div>
         </div>
         <div class="col-lg-12">
            <div class="form-group">
                 <label class="control-label">Are you Selling Tickets <i class="fas fa-info-circle" data-toggle="tooltip" title="Mark checkbox if you are selling Tickets"></i></label>
                  <div class="input-field-wrap">
                     <input type="checkbox" name="selling_ticket" id="selling" />
                  </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="form-group" style="display:none;">
               <label class="control-label">Ticket Template* <i class="fas fa-info-circle" data-toggle="tooltip" title="Choose your event style. You can create your own by choosing other in options."></i></label>
               <div class="input-field-wrap">
                  <select class="form-control" id="template_id" name="template_id">
                     <?php $EventTemplate = \App\EventTemplate::where('user_id',Auth::user()->id)->orderBy('id','ASC')->get(); ?>
                     @foreach($EventTemplate as $style)
                     <option value="{{$style->id}}">{{$style->template_name}}</option>
                     @endforeach
                     <!--  <option value="0">Others</option> -->
                  </select>
               </div>
            </div>
         </div>
         <div class="col-md-12">
            <div class="form-group ">  
               <label class="control-label cstm-label">Where do you want to organize this event?* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Organize this event"></i></label>
               <input name='media' id="media" type='radio' value="arrowchat" checked/> Arrow Chat<br>
               <input name='media' id="media" type='radio' value="googlemeet" /> Google Meet<br>
               <input name='media' id="media" type='radio' value="zoom" /> Zoom<br> 
            </div>
         </div>
         <div class="col-lg-12" >
            <div class="form-group">
               <label class="control-label payment-method-div">Do you want to add event team to help manage the Event?* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Manage event with team"></i></label>
               <input class="teamMembersAddOrNot" name='teamMembersAddOrNot' type='radio' value="yes" /> Yes
               <input class="teamMembersAddOrNot" name='teamMembersAddOrNot' type='radio' value="no" checked/> No
            </div>
            <div id="corporate_team_members">
               <div class="form-group">
                  <label class="control-label">Team Title <i class="fas fa-info-circle" data-toggle="tooltip" title="Team Title"></i></label>
                  <div class="input-field-wrap">
                     <input type="text" class="form-control" id="team_title" name="team_title" placeholder="Team Title">
                  </div>
               </div>
               <div class="team-wrapper-top">
                  <label class="control-label">Team Members <i class="fas fa-users" data-toggle="tooltip" data-placement="top" title="Add your team members."></i></label>
                  <button type="button" class="cstm-btn" id="addTeamMembers">Add</button>
               </div>
               <div id="teamMemberListing"></div>
            </div>
         </div>
         <div class="col-md-12" id="event_payment">
            <label class="control-label payment-method-div">Do you want to make this event paid?* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Add Different Type of tickets Like( Base,premium,Vip etc)"></i></label>
            <input name='payment_method' onchange="paymentChange(this);" type='radio' value="yes" /> Yes
            <input name='payment_method' onchange="paymentChange(this);" type='radio' value="no" checked/> No
            <div id="payment">
               <!--  Event Fee <input type="text" name="event_fee" id="event_fee" class="form-control"/><br> -->
               <table id="test-table" class="table table-condensed Registration-table">
                  <thead>
                     <tr>
                        <td>view price on ticket</td>
                        <th>Registration Type</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Seats</th>
                        <th><input type="button"  class='cstm-btn solid-btn' style="padding: 8px 13px !important;" id="dlt-row" value="-" onclick="deleteRows()" /></th>
                     </tr>
                  </thead>
                  <tbody id="test-body">
                     <tr id="row0">
                        <td>
                           <input type="radio" onchange="handleview_price(this)"  name="view_price" value="0">
                        </td>
                        <td>
                           <input type="text" class="form-control" name="reg_type_0"  style="text-transform:uppercase" class="reg_type" /> 
                        </td>
                        <td>
                           <input type="text" class="form-control" name="reg_price_0" class="reg_price" />
                        </td>
                        <td>
                           <textarea rows="4" class="form-control" name="reg_description_0" class="reg_description"></textarea>
                        </td>
                         <td>
                         	<input type="number" class="form-control reg_ticket_seat" onkeyup="seats(this)" placeholder="Ticket Seats" name="reg_seats_0" class="reg_ticket_seat">
                        </td>
                     </tr>
                  </tbody>
               </table>
               <input id='insert-more' class='cstm-btn solid-btn'  style="padding: 12px 11px!important;" type='button' value='Add' />
               <div class="available_seats"></div>
            </div>
         </div>
          <div class="col-md-12">
            <div class="form-group">
              <label class="control-label">Event Budget* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Enter your event budget."></i></label>
              <input type="text" class="form-control" name="event_budget" value="" id="event_budget" placeholder="Event Budget">
          </div>
           <!-- {{textbox($errors, 'Event Budget*', 'event_budget')}} -->
           </div>
      </div>
   </div>
   <div class="btn-wrap text-right">
      <button class="cstm-btn solid-btn btn-back-step" data-action="step2" data-step="2" type="button">Back</button>
      <button class="cstm-btn solid-btn">Save</button>
   </div>
   <input type="hidden" name="event_type" value="" id="fort_event_type">
   <input type="hidden" name="event" value="" id="fort_event">
   <input type="hidden" name="title" value="" id="fort_title">
   <input type="hidden" name="description" value="" id="fort_description">
   <input type="hidden" name="start_date" value="" id="fort_start_date">
   <input type="hidden" name="start_time" value="" id="fort_start_time">
   <input type="hidden" name="end_date" value="" id="fort_end_date">
   <input type="hidden" name="end_time" value="" id="fort_end_time">
   <input type="hidden" name="location" value="" id="fort_location">
   <input type="hidden" name="latitude" value="" id="fort_latitude">
   <input type="hidden" name="longitude" value="" id="fort_longitude">
   <input type="hidden" name="event_picture" value="" id="fort_event_picture">
   <input type="hidden" name="max_person" value="" id="fort_max_person">
   <input type="hidden" name="physical_seat" value="" id="fort_physical_seat">
    <input type="hidden" name="available_physical_seat" value="" id="physical_seat_available">
   <input type="hidden" name="virtual_seat" value="" id="fort_virtual_seat">
   <input type="hidden" name="event_registration" value="" id="fort_event_registration">
   <input type="hidden" name="reg_start_date" value="" id="fort_reg_start_date">
   <input type="hidden" name="reg_start_time" value="" id="fort_reg_start_time">
   <input type="hidden"  value="" id="fort_event_registration_type">
   <input type="hidden"  value="" id="fort_event_registration_price">
   <input type="hidden" value='0' name="counter" id="counter">
</form>
<style>
.field_wrapper .element .pick-color-field-wrap .acrdn-action-btns {
  right: -22px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
     var reg_payment = $('#payment');
     reg_payment.hide();
     $('input[name$="payment_method"]').change(function(){ 
       var inputData_payment = $(this).attr("value"); 
       if (inputData_payment == 'yes')
       { 
         reg_payment.show(); 
          
       }else{ 
          
         reg_payment.hide(); 
       } 
     });
  });
</script>
<script type="text/javascript">
    $("#insert-more").click(function () { 
   
      $("#test-table").each(function () {
          var counter = parseInt($('#counter').val())+1;
          console.log($('#counter').val());
          var tds = '<tr>';
          jQuery.each($('tr:last ', this), function () {
              tds += '<td><input type="radio" onchange="handleview_price(this)" name="view_price" value="'+counter+'"/></td><td><input type="text"  style="text-transform:uppercase" name="reg_type_' + counter + '" class="name_input form-control" class="reg_type" ></td><td><input type="text" name="reg_price_' + counter + '" class="email_input form-control" class="reg_price" ></td><td><textarea  rows="4" name="reg_description_' + counter + '" class="email_input form-control" id="reg_description" ></textarea></td><td><input type="number" name="reg_seats_'+counter+'" class="form-control reg_ticket_seat" onkeyup="seats(this)" /></td>';
          });

          tds += '</tr>';
      
          if ($('tbody', this).length > 0) {
            $('tbody', this).append(tds);
            $('#counter').val( counter );
          } else {
              $(this).append(tds);
          }
      });
    });
   function deleteRows(){
    var table = document.getElementById('test-table');
    var rowCount = table.rows.length;
    if(rowCount > '2'){
      var row = table.deleteRow(rowCount-1);
      rowCount--;
    }
    else{
    //alert('There should be atleast one row');
    }
   }

   function seats(e){
      var seats_assigned=0;
      document.querySelectorAll(".reg_ticket_seat").forEach((val)=>{ seats_assigned+=parseInt(val.value); });
      var seats_available=$("#physical_seat_available").val();
      seats_assigned=seats_assigned?seats_assigned:0;
    
      if(seats_available<seats_assigned){
         $(".available_seats").html("<strong>Seats Limit Exceed</strong>");
         $(".available_seats").addClass('limit_exceed');
         $("#insert-more").hide();
      }else{
         var seats=parseInt(seats_available)-seats_assigned;
         
         $(".available_seats").html("<h4>Available seats<strong>"+seats+"</strong></h4>");
         $(".available_seats").removeClass('limit_exceed');
         $("#insert-more").show();
         if(seats==0){
           $("#insert-more").hide();
         }
   }
 }

   $(document).on('change', '#template_id', function() {
    var id = $("#template_id option:selected").val();
    $.ajax({
        type: "GET",
        url: "<?= url(route('user.event.gettemplate')) ?>",
        data: { val: id },
        contentType: "application/json; charset=utf-8",
        dataType: "Json",
        success: function(result) {
            $('#ticket_preview').html(result);
            const event_title=$("#fort_title").val();
            $("#ticket_event_title").text(event_title);
            const location=$("#fort_location").val();
            $("#ticket_event_location").html(`<p><strong>${location}</strong></p>`);
            $("#ticket_price_type").hide();
            const start_date=$("#fort_start_date").val();
            const end_date=$("#fort_end_date").val();
            if(start_date==end_date){ $("#ticket_event_dates").html(start_date);  }else{ $("#ticket_event_dates").html(`<span class='event_dates'>${start_date} - ${end_date}</span>`)  }
            const start_time=$("#fort_start_time").val();
            const end_time=$("#fort_end_time").val();
            if($("#ticket_event_timings")){
              $("#ticket_event_timings").html(`${start_time} - ${end_time}`);
            }
            if($("#door_open_time")){
              $("#door_open_time").html(`${start_time}`);
            }
             if($("#door_close_time")){
              $("#door_close_time").html(`${end_time}`);
            }
        }

    });
});

   function paymentChange(e){
        if(e.value=='yes'){
            $("#ticket_price_type").show();
        }else{
            $("#ticket_price_type").hide();

        }
   }

   function handleview_price(e){
     const viewplanprice=e.value;
     // $(".reg_price").attr('class','reg_price');
     // $(".reg_type").attr('class','reg_type');
     // $(`input[name=reg_price_${viewplanprice}]`).attr('class','reg_price active');
     // $(`input[name=reg_type_${viewplanprice}]`).attr('class','reg_type active');
     const price=$(`input[name=reg_price_${viewplanprice}]`).val();
     const type=$(`input[name=reg_type_${viewplanprice}]`).val();
     $("#ticket_type").text(type);
     $('#ticket_price').text('$ '+price);   
   }
</script>