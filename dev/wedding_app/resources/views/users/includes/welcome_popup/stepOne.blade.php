<style>
   .tooltip {
   z-index: 1000000 !important;
   }
</style>
<form id="firstEventCreate">
   <div class="formFileds">
      <div class="row">
         <div class="col-lg-6">
            <div class="form-group">
               <label class="control-label">Event Type <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Events type like Anniversary,Baby Shower etc."></i></label>
               <div class="input-field-wrap">
                  <select class="form-control select2" id="event_type" name="event_type" data-action="{{route('user_get_event_category')}}">
                     <option value="">Select</option>
                     <?php $VendorEvents = \App\Event::where('status',1)->orderBy('name','ASC')->get(); ?>
                     @foreach($VendorEvents as $event)
                     <option value="{{$event->id}}">{{$event->name}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="form-group">
               <label class="control-label">Event Title <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Title!"></i></label>
               <div class="input-field-wrap">
                  <input type="text" class="form-control" name="title" id="title" placeholder="Event Title">
               </div>
            </div>
         </div>
         <div class="col-md-12">
            <div class="form-group ">
               <label class="control-label">Description* <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Tell us about your event. It will be shown on event page."></i></label>
               <textarea class="form-control myTextEditor" id="long_description" name="long_description" rows="4" col="10" spellcheck="false" placeholder="Type Here..."></textarea>
            </div>
         </div>
         <div class="col-md-12" id="table-csv">
            <label class="control-label cstm-label" style="font-weight: 600;">Would you like to register for the event?<i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Deadline of registration"></i> </label>
            <input name='event_registration' id="event_registration" type='radio' value="yes" /> Yes
            <input name='event_registration' id="event_registration" type='radio' value="no" checked /> No
            <div class="row" id="show-me">
               <div class="col-md-12">
                  <label class="control-label cstm-label" style="font-weight: 600;">Do you want to give the registration deadline?<i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="Deadline of registration"></i></label>
                  <input name='registration_deadline' id="registration_deadline" type='radio' value="1" /> Yes
                  <input name='registration_deadline' id="registration_deadline" type='radio' value="2" checked /> No
               </div>
            </div>
            <div class="row" id="show-me2">
               <div class="col-md-6">
                  {{datebox($errors, 'Date <i class="fas fa-info-circle" data-toggle="tooltip" title="End date of registration."></i>', 'reg_start_date')}}
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Time <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="End time of registration"></i> </label>
                     <div class='input-group date'>
                        <input type="text" id="reg_start_time" class="form-control" name="reg_start_time">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- <div class="col-lg-12">
            <div class="form-group">
              <label>Description <i class="fas fa-info-circle" data-toggle="tooltip" title="Description!"></i></label>
              <div class="input-field-wrap">
              <input type="text" class="form-control" id="description" name="description" placeholder="Short Description">
            </div>
            </div>
            </div> -->
         <div class="col-lg-12">
            <div class="form-group">
               <label class="control-label">Event Location <i class="fas fa-info-circle" data-toggle="tooltip" title="Event Place!"></i></label>
               <div class="input-field-wrap">
                  <input type="text" class="form-control" value="test" id="location" name="location" placeholder="Event Place">
                  <input type="hidden" name="latitude" id="latitude">
                  <input type="hidden" name="longitude" id="longitude">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="btn-wrap text-right">
      <button type="submit" class="cstm-btn solid-btn" id="test">Next</button>
   </div>
</form>
<style>
   .hideDiv{
   display: none;
   }
   .showDiv{
   display: block;
   }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css" integrity="sha256-SMGbWcp5wJOVXYlZJyAXqoVWaE/vgFA5xfrH3i/jVw0=" crossorigin="anonymous" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha256-5YmaxAwMjIpMrVlK84Y/+NjCpKnFYa8bWWBbUHSBGfU=" crossorigin="anonymous"></script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script> -->
<script>
   $('#table-csv').addClass('hideDiv');
    $(document).on('change','#event_type', function(){
     var event_id = $(this).val();
     if(event_id){
         $.ajax({
             type:'GET',
             url : "<?= url(route('user.event.getEventType')) ?>",
             data:{'event_id':event_id},
             contentType: "application/json; charset=utf-8",
             dataType: "Json",
             success:function(result){
               if(result.status == 'corporate')
               {
                   $('#table-csv').addClass('showDiv').removeClass('hideDiv');
                   $('#table-csv2').addClass('showDiv1').removeClass('hideDiv1');
                  
               }else{
                 $('#table-csv').addClass('hideDiv').removeClass('showDiv');
                 $('#event_payment').attr('style', 'display:none');
               }
                 
                
             }
         }); 
     }
   });
   
   
   
   $(document).ready(function() {
   var reg_deadline = $('#show-me');
   reg_deadline.hide();
   $('input[name$="event_registration"]').change(function() 
   { 
   var inputData = $(this).attr("value"); 
   if (inputData == 'yes') 
   { 
   reg_deadline.show(); 
   $('#event_payment').attr('style', 'display:block');
   }else{ 
   reg_deadline.hide();
   $('#event_payment').attr('style', 'display:none');
   
   }
   });
   });
   $(document).ready(function() {
   var reg_date = $('#show-me2');
   reg_date.hide();
   $('input[name$="registration_deadline"]').change(function() 
   { 
   var inputData1 = $(this).attr("value"); 
   if (inputData1 == '1')
   { 
   reg_date.show(); 
   
   }else{ 
   
   reg_date.hide(); 
   } 
   });
   });
   jQuery(document).ready(function($) {
   
   $('#reg_start_time').datetimepicker({
       format: 'LT'
   });
   });
</script>