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
                           <input type="color" onchange="GetColour(this)" class="ColorGet" style="width: 46px; margin-left: -2px;" name="colours[]" value="#000" id="event_color_name5">
                           <input type="text" onchange="GetColourName(this)" id="event_color_name5" value="black" class="form-control ColourSelect" name="colourNames[]" placeholder="Colour Name">
                           <ul class="input-group-btn color-btn acrdn-action-btns cs-plus" id="5">
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
         <div class="col-lg-6">
            <div class="form-group">
               <label class="control-label">Ticket Template* <i class="fas fa-info-circle" data-toggle="tooltip" title="Choose your event style. You can create your own by choosing other in options."></i></label>
               <div class="input-field-wrap">
                  <select class="form-control" id="template_id" name="template_id">
                     <?php $EventTemplate = \App\EventTemplate::where('user_id',Auth::user()->id)->orderBy('template_name','ASC')->get(); ?>
                     <option >Select Ticket Template</option>
                     @foreach($EventTemplate as $style)
                     <option value="{{$style->template_id}}">{{$style->template_name}}</option>
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
               <input name='media' id="media" type='radio' value="zoom" /> Zoom <br>
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
            <div class="form-group">
               <label class="control-label payment-method-div">Do you want to make this event paid?* <i class="fas fa-info-circle" data-toggle="tooltip" title="" data-original-title="Payment Methods"></i></label>
               <input name='payment_method' type='radio' value="yes" /> Yes
               <input name='payment_method' type='radio' value="no" checked/> No
               <div id="payment">
                  <!-- Event Fee <input type="text" name="event_fee" id="event_fee" class="form-control"/><br> -->
                  <table id="test-table" class="table table-condensed Registration-table">
                     <thead>
                        <tr>
                           <th>Registration Type</th>
                           <th>Price</th>
                           <th>Description</th>
                           <th><input type="button"  class='cstm-btn solid-btn' style="padding: 8px 13px !important;" id="dlt-row" value="-" onclick="deleteRows()" /></th>
                        </tr>
                     </thead>
                     <tbody id="test-body">
                        <tr id="row0">
                           <td>
                              <input type="text" class="form-control" name="reg_type[]" id="reg_type" /> 
                           </td>
                           <td>
                              <input type="text" class="form-control" name="reg_price[]" id="reg_price" />
                           </td>
                           <td>
                              <textarea rows="4" class="form-control" name="reg_description[]" id="reg_description"></textarea>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <input id='insert-more' class='cstm-btn solid-btn'  style="padding: 12px 11px!important;" type='button' value='Add' />
               </div>
            </div>
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
   <input type="hidden" name="banner_image" value="" id="fort_banner_image">
   <input type="hidden" name="max_person" value="" id="fort_max_person">
   <input type="hidden" name="event_registration" value="" id="fort_event_registration">
   <input type="hidden" name="reg_start_date" value="" id="fort_reg_start_date">
   <input type="hidden" name="reg_start_time" value="" id="fort_reg_start_time">
   <input type="hidden" name="capacity" value="" id="fort_capacity">
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
       var counter = parseInt($('#counter').val());
          var tds = '<tr>';
       jQuery.each($('tr:last ', this), function () {
           tds += '<td><input type="text" name="reg_type[]_' + counter + '" class="name_input form-control" id="reg_type" ></td><td><input type="text" name="reg_price[]_' + counter + '" class="email_input form-control" id="reg_price" ></td><td><textarea  rows="4" name="reg_description[]_' + counter + '" class="email_input form-control" id="reg_description" ></textarea></td>';
       });
       tds += '</tr>';
   
       if ($('tbody', this).length > 0) {
        
             $('tbody', this).append(tds);
              $('#counter').val( counter + 1 );
           
       } 
       else {
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
   
</script>
<script type="text/javascript">
   jQuery(document).ready(function ($) {
       var row=1;
     $(document).on("click", "#add-row", function () {
     var new_row = '<tr id="row' + row + '"><td> <input type="text" class="form-control" name="reg_type[]' + row + '" id="reg_type" /></td><td> <input type="text" class="form-control" name="price[]'+ row + '" id="price" /></td><td><input type="text" class="form-control" name="capacity[]'+ row + '" id="capacity"/></td><td><input class="delete-row cstm-btn solid-btn" type="button" value="-" /></td></tr>';
       //alert(new_row);
     $('#test-body').append(new_row);
       row++;
       return false;
     });
     
     // Remove criterion
     $(document).on("click", ".delete-row", function () {
     //  alert("deleting row#"+row);
       if(row>1) {
         $(this).closest('tr').remove();
         row--;
       }
       return false;
     });
   });
     
</script>